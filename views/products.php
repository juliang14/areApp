<?php
// views/products.php
// Vista completa para listar productos (usa $products proporcionado por el controlador)
// Asegúrate de tener: global $lang; y que $products venga del controller

global $lang;

ob_start();
?>
<div class="container my-5">
  <h1 class="mb-4 text-center"><?= htmlspecialchars($lang['products']['title'] ?? 'Nuestros Productos') ?></h1>

  <?php if (!empty($products) && is_array($products)): ?>
    <div class="row g-4">
      <?php foreach ($products as $product): 
        // Normalizar campos (por si la API usa nombres distintos)
        $id        = $product['id_product'] ?? $product['id'] ?? null;
        $name      = $product['name_product'] ?? $product['name'] ?? 'Unnamed';
        $desc      = $product['description'] ?? $product['desc'] ?? '';
        $priceRaw  = $product['price'] ?? null;
        $price     = $priceRaw !== null ? number_format(floatval(str_replace(',', '.', $priceRaw)), 2) : null;
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
                  <?php if ($price !== null): ?>
                    <?= htmlspecialchars($price) ?> <?= htmlspecialchars($lang['products']['currency'] ?? '$') ?>
                  <?php else: ?>
                    <span class="text-muted"><?= htmlspecialchars($lang['products']['no_price'] ?? 'N/A') ?></span>
                  <?php endif; ?>
                </p>

                <?php if ($category): ?>
                  <p class="mb-1 text-muted small"><?= htmlspecialchars($lang['products']['category'] ?? 'Categoría') ?>: <?= htmlspecialchars($category) ?></p>
                <?php endif; ?>

                <?php if ($stock !== null): ?>
                  <p class="mb-2 small <?= $stock == 0 ? 'text-danger' : 'text-muted' ?>">
                    <?= htmlspecialchars($lang['products']['stock_label'] ?? 'Stock') ?>: <?= htmlspecialchars($stock) ?>
                  </p>
                <?php endif; ?>

                <div class="d-grid gap-2">
                  <a href="index.php?url=product/view/<?= urlencode($id) ?>" class="btn btn-outline-primary">
                    <?= htmlspecialchars($lang['products']['view'] ?? 'Ver Detalle') ?>
                  </a>

                  <button
                    class="btn btn-primary add-to-cart-btn"
                    data-product-id="<?= htmlspecialchars($id) ?>"
                    <?= ($stock !== null && $stock <= 0) ? 'disabled' : '' ?>
                  >
                    <?= htmlspecialchars($lang['products']['buy'] ?? 'Comprar') ?>
                  </button>
                </div>
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
