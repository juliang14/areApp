<?php
// models/ContactModel.php
require_once __DIR__ . '/../utils/ApiClient.php';

class ContactModel {
    private $client;

    public function __construct($token = null) {
        $this->client = new ApiClient($token);
    }

    public function saveContact($name, $phone, $time) {
        return $this->client->post('/contact/createContact', [
            'name'      => $name,
            'phone'     => $phone,
            'preferred_time'   => $time
        ]);
    }

}
