<?php
// controllers/CartController.php

class CartController
{
    public function index()
    {
        // Procesar acciones del carrito por POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action    = $_POST['action']      ?? '';
            $productId = $_POST['product_id']  ?? null;

            // 🚨 Verificación: solo permitir acciones si el usuario está logueado
            if (empty($_SESSION['user'])) {
                // Redirige a login si intenta manipular el carrito sin sesión
                header('Location: index.php?url=login');
                exit;
            }

            // Asegurar estructura del carrito
            if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            switch ($action) {
                case 'add':
                    // Espera: product_id, name, price (entero)
                    if ($productId !== null) {
                        $name  = trim($_POST['name']  ?? '');
                        // Cast a entero (en BD viene 3000, 6000, etc.)
                        $price = (int)($_POST['price'] ?? 0);

                        if ($name !== '' && $price >= 0) {
                            if (!isset($_SESSION['cart'][$productId])) {
                                $_SESSION['cart'][$productId] = [
                                    'name'     => $name,
                                    'price'    => $price,
                                    'quantity' => 1,
                                ];
                            } else {
                                $_SESSION['cart'][$productId]['quantity']++;
                            }
                        }
                    }
                    break;

                case 'increase':
                    if ($productId !== null && isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity']++;
                    }
                    break;

                case 'decrease':
                    if ($productId !== null && isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity']--;
                        if ($_SESSION['cart'][$productId]['quantity'] <= 0) {
                            unset($_SESSION['cart'][$productId]);
                        }
                    }
                    break;

                case 'remove':
                    if ($productId !== null && isset($_SESSION['cart'][$productId])) {
                        unset($_SESSION['cart'][$productId]);
                    }
                    break;

                case 'clear':
                    $_SESSION['cart'] = [];
                    break;
            }

            // Actualizar contador del carrito
            $this->updateCartCount();

            // Evitar repost (PRG)
            header('Location: index.php?url=cart');
            exit;
        }

        // Render de la vista
        include __DIR__ . '/../views/cart.php';
    }

    /**
     * Suma cantidades para mostrar el contador en el header
     */
    private function updateCartCount(): void
    {
        $cart = $_SESSION['cart'] ?? [];
        $count = 0;
        foreach ($cart as $row) {
            $count += (int)($row['quantity'] ?? 0);
        }
        $_SESSION['cart_count'] = $count;
    }
}
