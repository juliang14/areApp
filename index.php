<?php
// areApp/index.php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

// Captura la ruta amigable
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$segments = $url === '' ? [] : explode('/', $url);

// Definir controlador y método por defecto
$controllerName = !empty($segments[0]) ? strtolower($segments[0]) : 'index';
$methodName     = $segments[1] ?? 'index';
$params         = array_slice($segments, 2);

// Construir la clase de controlador
$controllerClass = ucfirst($controllerName) . 'Controller';

if (!class_exists($controllerClass)) {
    header('HTTP/1.1 404 Not Found');
    exit("Controller '$controllerClass' not found.");
}

$controller = new $controllerClass();

if (!method_exists($controller, $methodName)) {
    header('HTTP/1.1 404 Not Found');
    exit("Method '$methodName' not found in controller '$controllerClass'.");
}

// Ejecutar el método con parámetros
call_user_func_array([$controller, $methodName], $params);