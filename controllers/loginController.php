<?php
// areApp/controllers/LoginController.php
require_once __DIR__ . '/../utils/ApiClient.php';

class LoginController {
    public function index() {
        include __DIR__ . '/../views/login.php';
    }

    public function authenticate() {
        session_start();
        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        $client = new ApiClient();
        $response = $client->post('/login', [
            'email'    => $email,
            'password' => $password
        ]);

        if (!empty($response['token'])) {
            $_SESSION['token'] = $response['token'];
            $_SESSION['user']  = $response['user'];
            header('Location: index.php');
            exit;
        }

        $_SESSION['error'] = $response['message'] ?? 'Invalid credentials';
        header('Location: index.php?url=login');
        exit;
    }
}