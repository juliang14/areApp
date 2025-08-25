<?php
// areApp/models/RegisterModel.php
require_once __DIR__ . '/../utils/ApiClient.php';

class RegisterModel {
    private $client;

    public function __construct($token = null) {
        $this->client = new ApiClient($token);
    }

    /**
     * Crea un nuevo usuario enviando los datos al backend
     * @param array $data
     * @return array Respuesta de la API
     */
    public function createUser($data) {
        return $this->client->post('/register', [
            'first_name'      => $data['first_name'],
            'middle_name'     => $data['middle_name'],
            'first_surname'   => $data['first_surname'],
            'second_surname'  => $data['second_surname'],
            'id_document'     => $data['id_document'],
            'document_number' => $data['document_number'],
            'age'             => $data['age'],
            'phone'           => $data['phone'],
            'address'         => $data['address'],
            'email'           => $data['email'],
            'password'        => $data['password'],
            'status'          => 'active',
            'id_role'         => 2
        ]);
    }
}
