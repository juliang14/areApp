<?php
// views/cart.php
global $lang;

ob_start();

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>
<div class="container my-5">
  <h1 class="mb-4 text-center"><?= htmlspecialchars($lang['cart']['title'] ?? 'Tu Carrito') ?></h1>

  <?php if (!empty($cart)): ?>
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th><?= htmlspecialchars($lang['cart']['product'] ?? 'Producto') ?></th>
          <th><?= htmlspecialchars($lang['cart']['price'] ?? 'Precio') ?></th>
          <th><?= htmlspecialchars($lang['cart']['quantity'] ?? 'Cantidad') ?></th>
          <th><?= htmlspecialchars($lang['cart']['subtotal'] ?? 'Subtotal') ?></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cart as $id => $item): 
          $name     = $item['name'];
          $price    = (int)$item['price'];   // usar como entero (pesos)
          $quantity = (int)$item['quantity'];
          $subtotal = $price * $quantity;
          $total   += $subtotal;
        ?>
          <tr>
            <td><?= htmlspecialchars($name) ?></td>
            <td>$<?= number_format($price, 0, ',', '.') ?></td>
            <td>
              <div class="d-flex align-items-center justify-content-center">
                <!-- Botón - -->
                <form method="post" action="index.php?url=cart" class="me-2">
                  <input type="hidden" name="action" value="decrease">
                  <input type="hidden" name="product_id" value="<?= $id ?>">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">−</button>
                </form>

                <span class="px-2"><?= $quantity ?></span>

                <!-- Botón + -->
                <form method="post" action="index.php?url=cart" class="ms-2">
                  <input type="hidden" name="action" value="increase">
                  <input type="hidden" name="product_id" value="<?= $id ?>">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                </form>
              </div>
            </td>
            <td>$<?= number_format($subtotal, 0, ',', '.') ?></td>
            <td>
              <form method="post" action="index.php?url=cart">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <button type="submit" class="btn btn-sm btn-danger">
                  <?= htmlspecialchars($lang['cart']['remove'] ?? 'Eliminar') ?>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-4">
      <!-- Botón vaciar carrito -->
      <form method="post" action="index.php?url=cart">
        <input type="hidden" name="action" value="clear">
        <button type="submit" class="btn btn-outline-danger">
          <?= htmlspecialchars($lang['cart']['clear'] ?? 'Vaciar Carrito') ?>
        </button>
      </form>

      <!-- Total -->
      <h4 class="mb-0">
        <?= htmlspecialchars($lang['cart']['total'] ?? 'Total') ?>: 
        <strong>$<?= number_format($total, 0, ',', '.') ?></strong>
      </h4>

      <!-- Finalizar compra -->
      <a href="index.php?url=checkout" class="btn btn-success">
        <?= htmlspecialchars($lang['cart']['checkout'] ?? 'Finalizar Compra') ?>
      </a>
    </div>

  <?php else: ?>
    <div class="alert alert-info text-center">
      <?= htmlspecialchars($lang['cart']['empty'] ?? 'Tu carrito está vacío.') ?>
    </div>
  <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
