<?php
// controllers/ProductsController.php
require_once __DIR__ . '/../models/ProductsModel.php';

class ProductsController
{
    private $model;

    public function __construct($token = null)
    {
        $this->model = new ProductsModel($token);
    }

    public function index()
    {

        $response = $this->model->getAllProducts();
        $products = $response['data']['products'] ?? [];

        include __DIR__ . '/../views/products.php';
    }
}
