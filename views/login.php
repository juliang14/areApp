<!-- views/login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h2 class="text-center mb-4">Iniciar Sesión</h2>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['success']); ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <!-- FORMULARIO LOGIN -->
            <form method="POST" action="index.php?url=login/authenticate">
                <div class="mb-3">
                    <label for="username" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="username" name="username" placeholder="Ingresa tu correo" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

            <p class="text-center mt-3">
                ¿Olvidaste tu contraseña? 
                <a href="#" data-bs-toggle="modal" data-bs-target="#recoverModal">Recupérala aquí</a>
            </p>

            <p class="text-center mt-1">
                ¿No tienes cuenta? <a href="index.php?url=register">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>

<!-- MODAL RECUPERAR CONTRASEÑA -->
<div class="modal fade" id="recoverModal" tabindex="-1" aria-labelledby="recoverModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recoverModalLabel">Recuperar contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="index.php?url=recover/send">
            <div class="mb-3">
                <label for="recoverEmail" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="recoverEmail" name="email" placeholder="Ingresa tu correo" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Enviar enlace de recuperación</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
