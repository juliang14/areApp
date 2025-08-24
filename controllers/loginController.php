<?php
// areApp/controllers/LoginController.php
require_once __DIR__ . '/../utils/ApiClient.php';

class LoginController {
    public function index() {
        include __DIR__ . '/../views/login.php';
    }

    public function authenticate() {
        session_start();
        $username = $_POST['username']    ?? '';
        $password = $_POST['password'] ?? '';

        $client = new ApiClient();
        $response = $client->post('/login', [
            'username'    => $username,
            'password' => $password
        ]);

        if (!empty($response['success']) && $response['success'] === true && !empty($response['data']['token'])) {
            $_SESSION['token']      = $response['data']['token'];
            $_SESSION['expiracion'] = $response['data']['expiracion'] ?? null;
            $_SESSION['user']       = $response['data']['user'] ?? [];

            // Redirigir al home
            header('Location: index.php');
            exit;
        }

        // Login fallido → guardar mensaje y redirigir al login
        $_SESSION['error'] = $response['message'] ?? 'Credenciales inválidas';
        header('Location: index.php?url=login');
        exit;
    }
}
