<?php
// areApp/views/home.php

// Traer la traducción cargada en index.php
global $lang;

// Productos destacados con URLs de Picsum
$featuredProducts = [
    ['id' => 1, 'name' => 'Arepa de Queso',       'price' => '3.50', 'image' => 'https://picsum.photos/seed/queso/400/300'],
    ['id' => 2, 'name' => 'Arepa Reina Pepiada',  'price' => '6.00', 'image' => 'https://picsum.photos/seed/reina/400/300'],
    ['id' => 3, 'name' => 'Arepa Pelúa',          'price' => '6.50', 'image' => 'https://picsum.photos/seed/pelua/400/300'],
];

ob_start();
?>

<div class="container my-5">
  <!-- Slider principal -->
  <div id="homeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="carousel-item <?= $i === 1 ? 'active' : '' ?>">
          <img src="https://picsum.photos/seed/arepas<?= $i ?>/1200/400" class="d-block w-100"
               alt="<?= htmlspecialchars($lang['home']["slider$i"]['title'] ?? '') ?>">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
            <h5><?= htmlspecialchars($lang['home']["slider$i"]['title'] ?? '') ?></h5>
            <p><?= htmlspecialchars($lang['home']["slider$i"]['text']  ?? '') ?></p>
          </div>
        </div>
      <?php endfor; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden"><?= htmlspecialchars($lang['home']['slider_control_prev'] ?? 'Anterior') ?></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden"><?= htmlspecialchars($lang['home']['slider_control_next'] ?? 'Siguiente') ?></span>
    </button>
  </div>

  <!-- Productos destacados -->
  <h2 class="mb-4"><?= htmlspecialchars($lang['home']['section_featured'] ?? 'Arepas Destacadas') ?></h2>
  <div class="row">
    <?php foreach ($featuredProducts as $prod): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="<?= htmlspecialchars($prod['image']) ?>" class="card-img-top"
               alt="<?= htmlspecialchars($prod['name']) ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($prod['name']) ?></h5>
            <p class="card-text">$<?= htmlspecialchars($prod['price']) ?></p>
            <a href="index.php?url=product/view/<?= $prod['id'] ?>" class="btn btn-primary mt-auto">
              <?= htmlspecialchars($lang['home']['button_view'] ?? 'Ver Detalle') ?>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Testimonios -->
  <h2 class="mt-5 mb-4"><?= htmlspecialchars($lang['home']['section_reviews'] ?? 'Reseñas de Clientes') ?></h2>
  <div class="row">
    <?php for ($i = 1; $i <= 3; $i++): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <img src="https://i.pravatar.cc/80?img=<?= $i + 30 ?>" class="rounded-circle mb-3" alt="avatar">
            <p class="card-text fst-italic">"<?= htmlspecialchars($lang['home']["review{$i}"]['text'] ?? '') ?>"</p>
            <h6 class="card-subtitle mt-3 text-muted"><?= htmlspecialchars($lang['home']["review{$i}"]['author'] ?? '') ?></h6>
          </div>
        </div>
      </div>
    <?php endfor; ?>
  </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
