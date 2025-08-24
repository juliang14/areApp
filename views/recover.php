<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h2 class="text-center mb-4">Recuperar contraseña</h2>
            <form method="POST" action="index.php?url=recover/send">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                </div>
                <button type="submit" class="btn btn-warning w-100">Enviar enlace de recuperación</button>
            </form>
            <p class="text-center mt-3">
                <a href="index.php?url=login">Volver al inicio de sesión</a>
            </p>
        </div>
    </div>
</div>
