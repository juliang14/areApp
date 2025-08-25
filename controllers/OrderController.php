<?php
require_once __DIR__ . '/../models/OrderModel.php';

class OrderController {
    private $model;

    public function __construct() {
        $token = $_SESSION['token'] ?? null;
        $this->model = new OrderModel($token);
    }

    public function execute() {
        $orderId = $_GET['order_id'] ?? null;
        $paypalOrderId = $_GET['paypal_order_id'] ?? null;

        if (!$orderId || !$paypalOrderId) {
            die("Faltan datos de la orden.");
        }

        // 1. Actualizar estado de la orden en el API
        $this->model->updateOrderStatus($orderId, $paypalOrderId);

        // 2. Consultar orden actualizada
        $orderDetails = $this->model->getOrderDetails($orderId);

        // 3. Separar items de la orden (puede ser más de uno)
        $orderItems = $orderDetails;

        // 4. Renderizar vista
        include __DIR__ . '/../views/orderExecute.php';
    }
}
