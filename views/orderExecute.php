<?php
global $lang;
ob_start();

// Si $orderItems está vacío, la orden no existe o no se pudo obtener
if (empty($orderItems)) {
    echo '<div class="container my-5">
            <h1 class="text-danger text-center">Orden no encontrada</h1>
          </div>';
    $content = ob_get_clean();
    include __DIR__ . '/layout.php';
    return;
}

// Tomamos los datos generales de la orden a partir del primer item
$orderInfo = $orderItems[0];
?>
<div class="container my-5">
    <div class="text-center mb-4">
        <?php if ($orderInfo['order_status'] === 'paid'): ?>
            <h1 class="text-success"><?= htmlspecialchars($lang['order']['success'] ?? '¡Pago Exitoso!') ?></h1>
            <p class="lead"><?= htmlspecialchars($lang['order']['thankyou'] ?? 'Gracias por tu compra.') ?></p>
        <?php else: ?>
            <h1 class="text-warning"><?= htmlspecialchars($lang['order']['pending'] ?? 'Pago pendiente') ?></h1>
            <p class="lead"><?= htmlspecialchars($lang['order']['contact'] ?? 'Por favor contacta soporte.') ?></p>
        <?php endif; ?>
    </div>

    <!-- Factura / Información de la orden -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?= htmlspecialchars($lang['order']['invoice'] ?? 'Factura de Compra') ?></h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6"><strong><?= htmlspecialchars($lang['order']['order_id'] ?? 'Número de Orden') ?>:</strong> <?= htmlspecialchars($orderInfo['id_order']) ?></div>
                <div class="col-md-6"><strong><?= htmlspecialchars($lang['order']['status'] ?? 'Estado') ?>:</strong> 
                    <span class="<?= $orderInfo['order_status'] === 'paid' ? 'text-success' : 'text-warning' ?>">
                        <?= htmlspecialchars($orderInfo['order_status']) ?>
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6"><strong><?= htmlspecialchars($lang['order']['customer'] ?? 'Cliente') ?>:</strong> <?= htmlspecialchars($orderInfo['customer_name']) ?></div>
                <div class="col-md-6"><strong><?= htmlspecialchars($lang['order']['date'] ?? 'Fecha') ?>:</strong> <?= htmlspecialchars($orderInfo['order_date']) ?></div>
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <h4><?= htmlspecialchars($lang['order']['total'] ?? 'Total') ?>: <span class="text-primary">$<?= number_format($orderInfo['total'], 0, ',', '.') ?></span></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de productos -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><?= htmlspecialchars($lang['order']['products'] ?? 'Productos') ?></h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th><?= htmlspecialchars($lang['cart']['image'] ?? 'Imagen') ?></th>
                        <th><?= htmlspecialchars($lang['cart']['product'] ?? 'Producto') ?></th>
                        <th><?= htmlspecialchars($lang['cart']['price'] ?? 'Precio') ?></th>
                        <th><?= htmlspecialchars($lang['cart']['quantity'] ?? 'Cantidad') ?></th>
                        <th><?= htmlspecialchars($lang['cart']['subtotal'] ?? 'Subtotal') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name_product']) ?>" width="50" height="50" class="img-fluid"></td>
                            <td><?= htmlspecialchars($item['name_product']) ?></td>
                            <td>$<?= number_format($item['unit_price'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td>$<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="index.php?url=home" class="btn btn-primary"><?= htmlspecialchars($lang['order']['back_home'] ?? 'Volver al Inicio') ?></a>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
