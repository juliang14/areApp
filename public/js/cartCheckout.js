document.addEventListener('DOMContentLoaded', () => {
    const btnCheckout = document.getElementById('btnCheckout');

    if (!btnCheckout) return;

    btnCheckout.addEventListener('click', async () => {
        const cart = window.cartData || [];
        const total = window.cartTotal || 0;
        const token = window.apiToken || '';
        const userId = window.userId || '';

        if (!cart || Object.keys(cart).length === 0) {
            showError("Tu carrito está vacío.");
            return;
        }

        if (!token || !userId) {
            showError("No estás autenticado. Por favor inicia sesión.");
            return;
        }

        try {
            showSpinner();

            const items = Object.keys(cart).map(key => ({
                id_product: parseInt(key),
                quantity: parseInt(cart[key].quantity)
            }));

            // Crear la orden en la API
            const response = await fetch('http://localhost/api/arepasApi/order/createOrder', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    user_id: userId,
                    items: items,
                    total: total
                })
            });

            const data = await response.json();
            hideSpinner();

            if (!data.success) {
                showError(data.message || "Error al crear la orden");
                return;
            }

            const paypalClientEncrypted = data.data.paypal;
            const orderId = data.data.order_id;
            const amount = data.data.total;

            // Desencriptar client_id
            const decryptedClientId = (await decryptClientId(paypalClientEncrypted)).split('|')[0];
            if (!decryptedClientId) {
                showError("Error al procesar PayPal");
                return;
            }

            // Crear modal PayPal si no existe
            let paypalModal = document.getElementById('paypalModal');
            if (!paypalModal) {
                paypalModal = document.createElement('div');
                paypalModal.id = 'paypalModal';
                paypalModal.className = 'modal fade';
                paypalModal.tabIndex = -1;
                paypalModal.innerHTML = `
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pago con PayPal</h5>
                                <button type="button" class="btn btn-danger" id="cancelPaymentBtn">Cancelar Pago</button>
                            </div>
                            <div class="modal-body">
                                <div id="paypalContainer"></div>
                                <div id="paypalSpinner" class="text-center my-3">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Cargando...</span>
                                    </div>
                                    <p>Preparando PayPal...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(paypalModal);
            }

            const modal = new bootstrap.Modal(paypalModal, {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();

            const cancelBtn = document.getElementById('cancelPaymentBtn');
            cancelBtn.addEventListener('click', async () => {
                // Avisar al backend que se canceló la orden
                try {
                    await fetch(`http://localhost/api/arepasApi/order/cancelOrder/${orderId}`, {
                        method: 'POST',
                        headers: { 
                            'Authorization': `Bearer ${token}`
                        }
                    });
                } catch (err) {
                    console.error("Error cancelando orden:", err);
                }
                modal.hide();
            });

            // Cargar PayPal SDK dinámicamente
            const script = document.createElement('script');
            const exchangeRate = 5000; // ejemplo: 1 USD = 5000 COP
            const amountUSD = (amount / exchangeRate).toFixed(2); // convertir a dólares
            script.src = `https://www.paypal.com/sdk/js?client-id=${decryptedClientId}&currency=USD`;
            script.onload = () => {
                document.getElementById('paypalSpinner').style.display = 'none';
                paypal.Buttons({
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [{
                                amount: { value: amountUSD }
                            }]
                        });
                    },
                    onApprove: (data, actions) => {
                        return actions.order.capture().then(details => {
                            window.location.href = `index.php?url=order/execute&order_id=${orderId}&paypal_order_id=${details.id}`;
                        });
                    },
                    onError: (err) => {
                        console.error(err);
                        showError("Error al procesar PayPal");
                        modal.hide();
                    }
                }).render('#paypalContainer');
            };
            document.body.appendChild(script);

        } catch (error) {
            hideSpinner();
            console.error(error);
            showError("Error al procesar la orden.");
        }
    });

    async function decryptClientId(encrypted) {
        try {
            const secret = window.dataS;
            if (!secret) throw new Error("Falta la clave de encriptación");

            const data = Uint8Array.from(atob(encrypted), c => c.charCodeAt(0));
            const iv = data.slice(0, 16);
            const cipher = data.slice(16);

            const keyBytes = new TextEncoder().encode(secret);
            const key = await crypto.subtle.importKey("raw", keyBytes, { name: "AES-CBC" }, false, ["decrypt"]);

            const decrypted = await crypto.subtle.decrypt({ name: "AES-CBC", iv: iv }, key, cipher);
            return new TextDecoder().decode(decrypted);
        } catch (e) {
            console.error("Error desencriptando client_id", e);
            return '';
        }
    }

    function showSpinner() {
        const spinner = document.getElementById('spinnerOverlay');
        if (spinner) spinner.style.display = 'flex';
    }

    function hideSpinner() {
        const spinner = document.getElementById('spinnerOverlay');
        if (spinner) spinner.style.display = 'none';
    }

    function showError(message) {
        const modalBody = document.getElementById('errorModalBody');
        modalBody.textContent = message;
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    }
});
