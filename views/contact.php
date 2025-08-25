<?php
// views/contact.php
global $lang;
ob_start();
?>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">
            <?= htmlspecialchars($lang['contact']['title'] ?? 'Contáctanos, te llamamos') ?>
          </h2>

          <?php if (!empty($_SESSION['contact_success'])): ?>
            <div class="alert alert-success text-center">
              <?= htmlspecialchars($_SESSION['contact_success']) ?>
            </div>
            <?php unset($_SESSION['contact_success']); ?>
          <?php elseif (!empty($_SESSION['contact_error'])): ?>
            <div class="alert alert-danger text-center">
              <?= htmlspecialchars($_SESSION['contact_error']) ?>
            </div>
            <?php unset($_SESSION['contact_error']); ?>
          <?php endif; ?>

          <form method="post" action="index.php?url=contact" novalidate>
            <div class="mb-3">
              <label for="name" class="form-label">
                <?= htmlspecialchars($lang['contact']['name'] ?? 'Nombre completo') ?>
              </label>
              <input type="text" class="form-control" id="name" name="name"
                     placeholder="Ej. Juan Pérez" required
                     value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">
                <?= htmlspecialchars($lang['contact']['phone'] ?? 'Teléfono de contacto') ?>
              </label>
              <input type="tel" class="form-control" id="phone" name="phone"
                     placeholder="Ej. 3001234567" required
                     value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
            </div>

            <div class="mb-3">
              <label for="time" class="form-label">
                <?= htmlspecialchars($lang['contact']['time'] ?? 'Horario preferido') ?>
              </label>
              <select class="form-select" id="time" name="time">
                <option value=""><?= htmlspecialchars($lang['contact']['select'] ?? 'Selecciona...') ?></option>
                <option value="morning" <?= (($_POST['time'] ?? '') === 'morning' ? 'selected' : '') ?>>
                  <?= htmlspecialchars($lang['contact']['morning'] ?? 'Mañana (8am - 12pm)') ?>
                </option>
                <option value="afternoon" <?= (($_POST['time'] ?? '') === 'afternoon' ? 'selected' : '') ?>>
                  <?= htmlspecialchars($lang['contact']['afternoon'] ?? 'Tarde (12pm - 6pm)') ?>
                </option>
                <option value="evening" <?= (($_POST['time'] ?? '') === 'evening' ? 'selected' : '') ?>>
                  <?= htmlspecialchars($lang['contact']['evening'] ?? 'Noche (6pm - 9pm)') ?>
                </option>
              </select>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">
                <?= htmlspecialchars($lang['contact']['submit'] ?? 'Solicitar llamada') ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
