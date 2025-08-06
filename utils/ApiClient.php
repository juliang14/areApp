<?php

class ApiClient {
    private $baseUrl;
    private $token;

    public function __construct($token = null) {
        $this->baseUrl = 'http://localhost/api/arepasApi'; // Cambia por tu URL real
        $this->token = $token;
    }

    private function sendRequest($method, $endpoint, $data = null) {
        $url = rtrim($this->baseUrl, '/') . $endpoint;
        $ch = curl_init($url);

        $headers = ['Content-Type: application/json'];
        if ($this->token) {
            $headers[] = 'Authorization: Bearer ' . $this->token;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['error' => true, 'message' => $error];
        }

        return json_decode($response, true);
    }

    public function get($endpoint)    { return $this->sendRequest('GET',    $endpoint); }
    public function post($endpoint, $data) { return $this->sendRequest('POST',   $endpoint, $data); }
    public function put($endpoint, $data)  { return $this->sendRequest('PUT',    $endpoint, $data); }
    public function delete($endpoint)  { return $this->sendRequest('DELETE', $endpoint); }
}