<?php
// NO session_start(): ya se inicia en index.php
$langCode  = $_SESSION['lang'] ?? 'es';
$langFile  = __DIR__ . '/../../lang/' . $langCode . '.json';
$lang      = file_exists($langFile) ? json_decode(file_get_contents($langFile), true) : [];
?>
<footer class="bg-dark text-light py-4 mt-auto">
  <div class="container text-center">
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($lang['site']['name'] ?? 'Arepa Sales') ?>. 
       <?= htmlspecialchars($lang['site']['all_rights_reserved'] ?? 'All rights reserved.') ?>
    </p>
    <p>
      <!-- Botones que abren los modales -->
      <a href="#" class="text-light me-3" data-bs-toggle="modal" data-bs-target="#privacyModal">
        <?= htmlspecialchars($lang['links']['privacy_policy'] ?? 'Privacy Policy') ?>
      </a>
      <a href="#" class="text-light" data-bs-toggle="modal" data-bs-target="#termsModal">
        <?= htmlspecialchars($lang['links']['terms_of_service'] ?? 'Terms of Service') ?>
      </a>
    </p>
  </div>
</footer>

<!-- Modal: Privacy Policy -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="privacyModalLabel">
          <?= htmlspecialchars($lang['links']['privacy_policy'] ?? 'Privacy Policy') ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          <?= htmlspecialchars($lang['privacy']['content'] ?? 'Aquí irá el texto de la política de privacidad...') ?>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <?= htmlspecialchars($lang['buttons']['close'] ?? 'Cerrar') ?>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Terms of Service -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">
          <?= htmlspecialchars($lang['links']['terms_of_service'] ?? 'Terms of Service') ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          <?= htmlspecialchars($lang['terms']['content'] ?? 'Aquí irá el texto de los términos y condiciones...') ?>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <?= htmlspecialchars($lang['buttons']['close'] ?? 'Cerrar') ?>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
