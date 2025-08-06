<?php
$user       = $_SESSION['user'] ?? null;
$cartCount  = $_SESSION['cart_count'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Arepa Sales</title>
  <!-- Bootstrap CSS (v5) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">ArepaSales</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php?url=home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?url=products">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?url=about">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?url=contact">Contact</a></li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item position-relative">
          <a class="nav-link" href="index.php?url=cart">
            <i class="bi bi-cart"></i> Cart
            <?php if($cartCount > 0): ?>
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                <?= $cartCount ?>
              </span>
            <?php endif; ?>
          </a>
        </li>
        <?php if($user): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              <?= htmlspecialchars($user['first_name']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="index.php?url=profile">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="index.php?url=logout">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="index.php?url=login">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?url=register">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!-- Optional page header end -->
