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
          <th><?= htmlspecialchars($lang['cart']['image'] ?? 'Imagen') ?></th>
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
          $price    = (int)$item['price'];
          $quantity = (int)$item['quantity'];
          $image    = $item['image'] ?? 'assets/img/default.png';
          $subtotal = $price * $quantity;
          $total   += $subtotal;
        ?>
          <tr>
            <td><img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>" width="50" height="50" class="img-fluid"></td>
            <td><?= htmlspecialchars($name) ?></td>
            <td>$<?= number_format($price, 0, ',', '.') ?></td>
            <td>
              <div class="d-flex align-items-center justify-content-center">
                <form method="post" action="index.php?url=cart" class="me-2">
                  <input type="hidden" name="action" value="decrease">
                  <input type="hidden" name="product_id" value="<?= $id ?>">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">−</button>
                </form>
                <span class="px-2"><?= $quantity ?></span>
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
      <form method="post" action="index.php?url=cart">
        <input type="hidden" name="action" value="clear">
        <button type="submit" class="btn btn-outline-danger">
          <?= htmlspecialchars($lang['cart']['clear'] ?? 'Vaciar Carrito') ?>
        </button>
      </form>

      <h4 class="mb-0">
        <?= htmlspecialchars($lang['cart']['total'] ?? 'Total') ?>: 
        <strong>$<?= number_format($total, 0, ',', '.') ?></strong>
      </h4>

      <button id="btnCheckout" class="btn btn-success">
        <?= htmlspecialchars($lang['cart']['checkout'] ?? 'Finalizar Compra') ?>
      </button>
    </div>

  <?php else: ?>
    <div class="alert alert-info text-center">
      <?= htmlspecialchars($lang['cart']['empty'] ?? 'Tu carrito está vacío.') ?>
    </div>
  <?php endif; ?>
</div>

<!-- Modal de errores -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="errorModalBody"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div id="spinnerOverlay" class="d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 
     d-flex align-items-center justify-content-center" style="z-index:1050;">
    <div class="spinner-border text-light" role="status" style="width:3rem; height:3rem;">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>


<script>
    // Pasar los datos del carrito al JS
    window.cartData = <?= json_encode($cart) ?>;
    window.cartTotal = <?= json_encode($total) ?>;
    window.apiToken = <?= json_encode($_SESSION['token'] ?? '') ?>;
    window.userId = <?= json_encode($_SESSION['user']['id'] ?? '') ?>;
    window.dataS = <?= json_encode($_ENV['ENCRYPT_SECRET']) ?>;
</script>
<script src="public/js/cartCheckout.js"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
