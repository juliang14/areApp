<?php
// models/ProductsModel.php
require_once __DIR__ . '/../utils/ApiClient.php';

class ProductsModel
{
    private $client;

    public function __construct($token = null)
    {
        $this->client = new ApiClient($token);
    }

    /**
     * Obtener todos los productos desde la API
     * @return array
     */
    public function getAllProducts()
    {
        return $this->client->post('/products/get', [
            'type' => 'ALL'
        ]);
    }
}
