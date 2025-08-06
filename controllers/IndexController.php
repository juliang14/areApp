<?php
// areApp/controllers/IndexController.php

class IndexController {
    public function index() {
        // Vista principal
        include __DIR__ . '/../views/home.php';
    }
}