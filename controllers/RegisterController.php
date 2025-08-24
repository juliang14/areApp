<?php
// areApp/controllers/RegisterController.php
require_once __DIR__ . '/../utils/ApiClient.php';

class RegisterController {
    public function index() {
        include __DIR__ . '/../views/register.php';
    }

    public function store() {
        session_start();

        $name                  = $_POST['name'] ?? '';
        $email                 = $_POST['email'] ?? '';
        $password              = $_POST['password'] ?? '';
        $password_confirmation = $_POST['password_confirmation'] ?? '';

        if ($password !== $password_confirmation) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            header("Location: index.php?url=register");
            exit;
        }

        $client = new ApiClient();
        $response = $client->post('/register', [
            'name'     => $name,
            'email'    => $email,
            'password' => $password
        ]);

        if (!empty($response['success']) && $response['success'] === true) {
            $_SESSION['success'] = $response['message'] ?? 'Registro exitoso, ahora puedes iniciar sesión';
            header("Location: index.php?url=login");
            exit;
        }

        $_SESSION['error'] = $response['message'] ?? 'Error en el registro';
        header("Location: index.php?url=register");
        exit;
    }
}
