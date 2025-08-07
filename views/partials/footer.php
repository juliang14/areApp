<?php
// NO session_start(): ya se inicia en index.php
$langCode  = $_SESSION['lang'] ?? 'es';
$langFile = __DIR__ . '/../../lang/' . $langCode . '.json';
$lang = file_exists($langFile) ? json_decode(file_get_contents($langFile), true) : [];
?>
<footer class="bg-dark text-light py-4 mt-auto">
  <div class="container text-center">
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($lang['site']['name'] ?? 'Arepa Sales') ?>. <?= htmlspecialchars($lang['site']['all_rights_reserved'] ?? 'All rights reserved.') ?></p>
    <p>
      <a href="index.php?url=privacy" class="text-light me-3"><?= htmlspecialchars($lang['links']['privacy_policy'] ?? 'Privacy Policy') ?></a>
      <a href="index.php?url=terms" class="text-light"><?= htmlspecialchars($lang['links']['terms_of_service'] ?? 'Terms of Service') ?></a>
    </p>
  </div>
</footer>
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
