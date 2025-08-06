<!-- areApp/views/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Arepa Sales</title>
</head>
<body>
  <?php session_start(); ?>
  <?php if (!empty($_SESSION['error'])): ?>
    <div class="error"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <form method="POST" action="index.php?url=login/authenticate">
    <label>
      Email:
      <input type="email" name="email" required>
    </label><br>
    <label>
      Password:
      <input type="password" name="password" required>
    </label><br>
    <button type="submit">Log In</button>
  </form>
</body>
</html>