<!-- views/register.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #passwordStrength {
            height: 8px;
        }
        .strength-label {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Crear Cuenta</h2>

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

                    <!-- FORMULARIO REGISTRO -->
                    <form method="POST" action="index.php?url=register/store" id="registerForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">Primer nombre</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="middle_name" class="form-label">Segundo nombre</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="first_surname" class="form-label">Primer apellido</label>
                                <input type="text" class="form-control" id="first_surname" name="first_surname" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="second_surname" class="form-label">Segundo apellido</label>
                                <input type="text" class="form-control" id="second_surname" name="second_surname">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_document" class="form-label">Tipo de documento</label>
                                <select class="form-select" id="id_document" name="id_document" required>
                                    <option value="">Seleccione...</option>
                                    <option value="1">Cédula de ciudadanía</option>
                                    <option value="2">Tarjeta de identidad</option>
                                    <option value="3">Pasaporte</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="document_number" class="form-label">Número de documento</label>
                                <input type="text" class="form-control" id="document_number" name="document_number" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="age" name="age" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <!-- CONTRASEÑA CON BARRA DE SEGURIDAD -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Mínimo 8 caracteres, mayúscula, minúscula, número y símbolo" required>
                            <div class="progress mt-2">
                                <div id="passwordStrength" class="progress-bar" role="progressbar"></div>
                            </div>
                            <div id="strengthMessage" class="strength-label mt-1"></div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <div id="matchMessage" class="strength-label mt-1"></div>
                        </div>

                        <input type="hidden" name="status" value="ACTIVO">

                        <button type="submit" class="btn btn-success w-100">Registrarme</button>
                    </form>

                    <p class="text-center mt-3">
                        ¿Ya tienes cuenta? <a href="index.php?url=login">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const passwordInput = document.getElementById("password");
const confirmInput = document.getElementById("confirm_password");
const strengthBar = document.getElementById("passwordStrength");
const strengthMessage = document.getElementById("strengthMessage");
const matchMessage = document.getElementById("matchMessage");

passwordInput.addEventListener("input", () => {
    const val = passwordInput.value;
    let strength = 0;

    if (val.match(/[a-z]/)) strength++;       // minúscula
    if (val.match(/[A-Z]/)) strength++;       // mayúscula
    if (val.match(/[0-9]/)) strength++;       // número
    if (val.match(/[@$!%*?&]/)) strength++;   // carácter especial
    if (val.length >= 8) strength++;          // mínimo 8 caracteres

    // Configurar barra
    let width = (strength / 5) * 100;
    strengthBar.style.width = width + "%";

    if (strength <= 2) {
        strengthBar.className = "progress-bar bg-danger";
        strengthMessage.textContent = "Contraseña débil";
    } else if (strength === 3 || strength === 4) {
        strengthBar.className = "progress-bar bg-warning";
        strengthMessage.textContent = "Contraseña media";
    } else if (strength === 5) {
        strengthBar.className = "progress-bar bg-success";
        strengthMessage.textContent = "Contraseña fuerte";
    }
});

confirmInput.addEventListener("input", () => {
    if (confirmInput.value !== passwordInput.value) {
        matchMessage.textContent = "Las contraseñas no coinciden";
        matchMessage.style.color = "red";
    } else {
        matchMessage.textContent = "Las contraseñas coinciden";
        matchMessage.style.color = "green";
    }
});

// Validación final antes de enviar
document.getElementById("registerForm").addEventListener("submit", function(e) {
    if (strengthBar.style.width !== "100%") {
        e.preventDefault();
        alert("La contraseña debe ser fuerte antes de continuar.");
    }
    if (confirmInput.value !== passwordInput.value) {
        e.preventDefault();
        alert("Las contraseñas no coinciden.");
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
