<?php
// controllers/ContactController.php
require_once __DIR__ . '/../models/ContactModel.php';

class ContactController {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $time  = trim($_POST['time'] ?? '');

            if ($name && $phone) {
                $model = new ContactModel();
                $saved = $model->saveContact($name, $phone, $time);

                if ($saved) {
                    $_SESSION['contact_success'] = "¡Gracias $name! Te llamaremos pronto 📞";
                } else {
                    $_SESSION['contact_error'] = "Ocurrió un error al guardar tu solicitud.";
                }
            } else {
                $_SESSION['contact_error'] = "Por favor completa todos los campos requeridos.";
            }

            header("Location: index.php?url=contact");
            exit;
        }

        require __DIR__ . '/../views/contact.php';
    }
}
