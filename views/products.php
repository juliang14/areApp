<?php
// views/products.php
// Vista completa para listar productos (usa $products proporcionado por el controlador)

global $lang;
ob_start();
?>
<div class="container my-5">
  <h1 class="mb-4 text-center"><?= htmlspecialchars($lang['products']['title'] ?? 'Nuestros Productos') ?></h1>

  <?php if (!empty($products) && is_array($products)): ?>
    <div class="row g-4">
      <?php foreach ($products as $product): 
        $id        = $product['id_product'] ?? $product['id'] ?? null;
        $name      = $product['name_product'] ?? $product['name'] ?? 'Unnamed';
        $desc      = $product['description'] ?? $product['desc'] ?? '';
        $price     = (int)($product['price'] ?? 0); // en BD: 3000, 6000…
        $stock     = $product['stock'] ?? null;
        $image     = $product['image_url'] ?? $product['image'] ?? '';
        $category  = $product['category'] ?? '';
      ?>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm">
          <img
            src="<?= htmlspecialchars($image) ?>"
            alt="<?= htmlspecialchars($name) ?>"
            class="card-img-top"
            onerror="if(!this.dataset.err){this.dataset.err=1;this.src='/assets/img/no-image.png';}"
            loading="lazy"
          >
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($name) ?></h5>
            <?php if ($desc): ?>
              <p class="card-text text-muted small mb-2"><?= htmlspecialchars($desc) ?></p>
            <?php endif; ?>

            <div class="mt-auto">
              <p class="mb-1">
                <strong><?= htmlspecialchars($lang['products']['price_label'] ?? 'Precio') ?>:</strong>
                <?= number_format($price, 0, ',', '.') ?> COP
              </p>

              <?php if ($category): ?>
                <p class="mb-1 text-muted small">
                  <?= htmlspecialchars($lang['products']['category'] ?? 'Categoría') ?>:
                  <?= htmlspecialchars($category) ?>
                </p>
              <?php endif; ?>

              <?php if ($stock !== null): ?>
                <p class="mb-2 small <?= $stock == 0 ? 'text-danger' : 'text-muted' ?>">
                  <?= htmlspecialchars($lang['products']['stock_label'] ?? 'Stock') ?>: <?= htmlspecialchars($stock) ?>
                </p>
              <?php endif; ?>

              <!-- Si el usuario está logueado: muestra botón de comprar -->
              <?php if (!empty($_SESSION['user'])): ?>
                <form method="post" action="index.php?url=cart" class="d-grid gap-2">
                  <input type="hidden" name="action" value="add">
                  <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
                  <input type="hidden" name="name" value="<?= htmlspecialchars($name) ?>">
                  <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
                  <input type="hidden" name="image" value="<?= htmlspecialchars($image) ?>">
                  <button
                    type="submit"
                    class="btn btn-primary"
                    <?= ($stock !== null && $stock <= 0) ? 'disabled' : '' ?>
                  >
                    <?= htmlspecialchars($lang['products']['buy'] ?? 'Comprar') ?>
                  </button>
                </form>
              <?php else: ?>
                <div class="alert alert-warning p-2 text-center small">
                  <?= htmlspecialchars($lang['products']['login_required'] ?? 'Debes iniciar sesión para comprar.') ?>
                </div>
                <a href="index.php?url=login" class="btn btn-outline-primary w-100">
                  <?= htmlspecialchars($lang['products']['go_login'] ?? 'Iniciar sesión') ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-info text-center">
      <?= htmlspecialchars($lang['products']['no_products'] ?? 'No hay productos disponibles en este momento.') ?>
    </div>
  <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
