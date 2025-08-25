<?php
// views/about.php
global $lang;
ob_start();
?>
<div class="container my-5">
  <h1 class="mb-4 text-center">
    <?= htmlspecialchars($lang['about']['title'] ?? 'Acerca de Nosotros') ?>
  </h1>

  <div class="row g-4">
    <div class="col-md-6">
      <img
        src="/areApp/public/img/LogoArepas.jpg"
        class="img-fluid rounded shadow"
        alt="<?= htmlspecialchars($lang['about']['image_alt'] ?? 'Nuestro equipo') ?>"
        loading="lazy"
        onerror="if(!this.dataset.err){this.dataset.err=1;this.src='/assets/img/no-image.png';}"
      >
    </div>

    <div class="col-md-6 d-flex flex-column justify-content-center mt-5">
      <h3><?= htmlspecialchars($lang['about']['subtitle'] ?? 'Quiénes Somos') ?></h3>
      <p class="text-muted">
        <?= htmlspecialchars($lang['about']['description'] ?? 'Somos una empresa dedicada a ofrecer productos y servicios de calidad, siempre comprometidos con nuestros clientes y el desarrollo sostenible.') ?>
      </p>

      <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item">
          <i class="bi bi-people-fill text-primary"></i>
          <?= htmlspecialchars($lang['about']['value1'] ?? 'Equipo apasionado y profesional') ?>
        </li>
        <li class="list-group-item">
          <i class="bi bi-lightbulb-fill text-warning"></i>
          <?= htmlspecialchars($lang['about']['value2'] ?? 'Innovación constante en nuestros procesos') ?>
        </li>
        <li class="list-group-item">
          <i class="bi bi-shield-check text-success"></i>
          <?= htmlspecialchars($lang['about']['value3'] ?? 'Compromiso con la confianza y la seguridad') ?>
        </li>
      </ul>

      <a href="index.php?url=contact" class="btn btn-primary mt-2">
        <?= htmlspecialchars($lang['about']['cta'] ?? 'Contáctanos') ?>
      </a>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
