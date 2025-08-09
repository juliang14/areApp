<?php
// areApp/views/home.php

// Traer la traducción cargada en index.php
global $lang;

ob_start();
?>

<div class="container my-5">
  <!-- Slider principal -->
  <div id="homeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://picsum.photos/seed/arepas1/1200/400" class="d-block w-100"
             alt="<?= htmlspecialchars($lang['home']["slider1"]['title'] ?? '') ?>">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
          <h5><?= htmlspecialchars($lang['home']["slider1"]['title'] ?? '') ?></h5>
          <p><?= htmlspecialchars($lang['home']["slider1"]['text']  ?? '') ?></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://picsum.photos/seed/arepas2/1200/400" class="d-block w-100"
             alt="<?= htmlspecialchars($lang['home']["slider2"]['title'] ?? '') ?>">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
          <h5><?= htmlspecialchars($lang['home']["slider2"]['title'] ?? '') ?></h5>
          <p><?= htmlspecialchars($lang['home']["slider2"]['text']  ?? '') ?></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://picsum.photos/seed/arepas3/1200/400" class="d-block w-100"
             alt="<?= htmlspecialchars($lang['home']["slider3"]['title'] ?? '') ?>">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
          <h5><?= htmlspecialchars($lang['home']["slider3"]['title'] ?? '') ?></h5>
          <p><?= htmlspecialchars($lang['home']["slider3"]['text']  ?? '') ?></p>
        </div>
      </div>
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
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="https://picsum.photos/seed/queso/400/300" class="card-img-top"
             alt="Arepa de Queso">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Arepa de Queso</h5>
          <p class="card-text">$3.50</p>
          <a href="index.php?url=product/view/1" class="btn btn-primary mt-auto">
            <?= htmlspecialchars($lang['home']['button_view'] ?? 'Ver Detalle') ?>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="https://picsum.photos/seed/reina/400/300" class="card-img-top"
             alt="Arepa Reina Pepiada">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Arepa Reina Pepiada</h5>
          <p class="card-text">$6.00</p>
          <a href="index.php?url=product/view/2" class="btn btn-primary mt-auto">
            <?= htmlspecialchars($lang['home']['button_view'] ?? 'Ver Detalle') ?>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="https://picsum.photos/seed/pelua/400/300" class="card-img-top"
             alt="Arepa Pelúa">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Arepa Pelúa</h5>
          <p class="card-text">$6.50</p>
          <a href="index.php?url=product/view/3" class="btn btn-primary mt-auto">
            <?= htmlspecialchars($lang['home']['button_view'] ?? 'Ver Detalle') ?>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Testimonios -->
  <h2 class="mt-5 mb-4"><?= htmlspecialchars($lang['home']['section_reviews'] ?? 'Reseñas de Clientes') ?></h2>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <img src="https://i.pravatar.cc/80?img=31" class="rounded-circle mb-3" alt="avatar">
          <p class="card-text fst-italic">"<?= htmlspecialchars($lang['home']["review1"]['text'] ?? '') ?>"</p>
          <h6 class="card-subtitle mt-3 text-muted"><?= htmlspecialchars($lang['home']["review1"]['author'] ?? '') ?></h6>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <img src="https://i.pravatar.cc/80?img=32" class="rounded-circle mb-3" alt="avatar">
          <p class="card-text fst-italic">"<?= htmlspecialchars($lang['home']["review2"]['text'] ?? '') ?>"</p>
          <h6 class="card-subtitle mt-3 text-muted"><?= htmlspecialchars($lang['home']["review2"]['author'] ?? '') ?></h6>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <img src="https://i.pravatar.cc/80?img=33" class="rounded-circle mb-3" alt="avatar">
          <p class="card-text fst-italic">"<?= htmlspecialchars($lang['home']["review3"]['text'] ?? '') ?>"</p>
          <h6 class="card-subtitle mt-3 text-muted"><?= htmlspecialchars($lang['home']["review3"]['author'] ?? '') ?></h6>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
