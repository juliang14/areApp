<?php
// areApp/controllers/LogoutController.php
class LogoutController {
    public function index() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
