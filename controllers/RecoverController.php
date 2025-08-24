<?php
// areApp/controllers/RecoverController.php
require_once __DIR__ . '/../utils/ApiClient.php';

class RecoverController {
    public function index() {
        include __DIR__ . '/../views/recover.php';
    }

    public function send() {
        session_start();

        $email = $_POST['email'] ?? '';

        if (empty($email)) {
            $_SESSION['error'] = "El correo es obligatorio.";
            header("Location: index.php?url=recover");
            exit;
        }

        $client = new ApiClient();
        $response = $client->post('/recover', ['email' => $email]);

        if (!empty($response['success']) && $response['success'] === true) {
            $_SESSION['success'] = $response['message'] ?? 'Se ha enviado un enlace de recuperación a tu correo';
            header("Location: index.php?url=login");
            exit;
        }

        $_SESSION['error'] = $response['message'] ?? 'Error al enviar el correo de recuperación';
        header("Location: index.php?url=recover");
        exit;
    }
}
