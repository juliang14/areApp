<?php
// areApp/controllers/RegisterController.php
require_once __DIR__ . '/../models/RegisterModel.php';

class RegisterController {
    public function index() {
        include __DIR__ . '/../views/register.php';
    }

    public function store() {
        session_start();

        $data = [
            'first_name'      => $_POST['first_name'] ?? '',
            'middle_name'     => $_POST['middle_name'] ?? '',
            'first_surname'   => $_POST['first_surname'] ?? '',
            'second_surname'  => $_POST['second_surname'] ?? '',
            'id_document'     => $_POST['id_document'] ?? '',
            'document_number' => $_POST['document_number'] ?? '',
            'age'             => $_POST['age'] ?? '',
            'phone'           => $_POST['phone'] ?? '',
            'address'         => $_POST['address'] ?? '',
            'email'           => $_POST['email'] ?? '',
            'password'        => $_POST['password'] ?? ''
        ];

        $model = new RegisterModel();
        $response = $model->createUser($data);

        if (!empty($response['success']) && $response['success'] === true) {
            $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
            header('Location: index.php?url=login');
            exit;
        }

        $_SESSION['error'] = $response['message'] ?? "Error al registrar el usuario.";
        header('Location: index.php?url=register');
        exit;
    }
}
