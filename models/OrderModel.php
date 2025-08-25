<?php
require_once __DIR__ . '/../utils/ApiClient.php';

class OrderModel {
    private $client;

    public function __construct($token = null) {
        $this->client = new ApiClient($token);
    }

    // 1. Actualizar estado de la orden en la base de datos mediante API
    public function updateOrderStatus($orderId, $paypalOrderId) {
        $payload = [
            'id_order' => $orderId,
            'paypal_order_id' => $paypalOrderId
        ];
        $response = $this->client->post("/order/updateOrderStatus", $payload);
        if (!$response || !isset($response['success']) || !$response['success']) {
            return null;
        }
        return $response['data'] ?? [];
    }

    // 2. Obtener los detalles de la orden desde el API
    public function getOrderDetails($orderId) {
        $response = $this->client->post("/order/getOrders", ['id_order' => $orderId]);
        if (!$response || !isset($response['success']) || !$response['success']) {
            return null;
        }
        return $response['data'] ?? [];
    }

}
