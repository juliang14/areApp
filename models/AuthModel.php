<?php
// areApp/models/AuthModel.php
require_once __DIR__ . '/../utils/ApiClient.php';

class AuthModel {
    private $client;

    public function __construct($token = null) {
        $this->client = new ApiClient($token);
    }

    /**
     * Attempt to login with given credentials
     * @param string $email
     * @param string $password
     * @return array Response with 'token', 'user', etc.
     */
    public function login($email, $password) {
        return $this->client->post('/login', [
            'email'    => $email,
            'password' => $password
        ]);
    }
}