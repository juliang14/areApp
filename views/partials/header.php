<?php
// NO session_start(): ya se inicia en index.php

$user      = $_SESSION['user'] ?? null;
$cartCount = $_SESSION['cart_count'] ?? 0;
$langCode  = $_SESSION['lang'] ?? 'es';

// Carga traducciones desde JSON
$langFile = __DIR__ . '/../../lang/' . $langCode . '.json';
if (file_exists($langFile)) {
    $lang = json_decode(file_get_contents($langFile), true);
} else {
    $lang = [];
}
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($langCode) ?>">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($lang['site']['name'] ?? 'Arepa Sales') ?></title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php"><?= htmlspecialchars($lang['menu']['home'] ?? 'Home') ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php"><?= htmlspecialchars($lang['menu']['home'] ?? 'Home') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?url=products"><?= htmlspecialchars($lang['menu']['products'] ?? 'Products') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?url=about"><?= htmlspecialchars($lang['menu']['about'] ?? 'About Us') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?url=contact"><?= htmlspecialchars($lang['menu']['contact'] ?? 'Contact') ?></a></li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item position-relative">
          <a class="nav-link" href="index.php?url=cart">
            <i class="bi bi-cart"></i> <?= htmlspecialchars($lang['menu']['cart'] ?? 'Cart') ?>
            <?php if ($cartCount > 0): ?>
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle"><?= $cartCount ?></span>
            <?php endif; ?>
          </a>
        </li>

        <?php if ($user): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              <?= htmlspecialchars($user['first_name']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="index.php?url=profile"><?= htmlspecialchars($lang['menu']['profile'] ?? 'Profile') ?></a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="index.php?url=logout"><?= htmlspecialchars($lang['menu']['logout'] ?? 'Logout') ?></a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="index.php?url=login"><?= htmlspecialchars($lang['menu']['login'] ?? 'Login') ?></a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?url=register"><?= htmlspecialchars($lang['menu']['register'] ?? 'Register') ?></a></li>
        <?php endif; ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><?= strtoupper($langCode) ?></a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="?lang=es">ES</a></li>
            <li><a class="dropdown-item" href="?lang=en">EN</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- fin header -->
