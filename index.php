<?php
use Dotenv\Dotenv;

// areApp/index.php

// 1) Iniciar sesión y cargar autoload de Composer
session_start();
require_once __DIR__ . '/vendor/autoload.php';
Dotenv::createImmutable(__DIR__)->load();

// 2) Gestión de idioma
if (isset($_GET['lang']) && in_array($_GET['lang'], ['es', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$langCode = $_SESSION['lang'] ?? 'es';

// 3) Cargar traducciones JSON
$langFile = __DIR__ . "/lang/{$langCode}.json";
if (is_readable($langFile)) {
    $lang = json_decode(file_get_contents($langFile), true);
} else {
    $lang = [];
}

// 4) Capturar ruta amigable
$url = $_GET['url'] ?? '';
$url = trim($url, '/');
$segments = $url === '' ? [] : explode('/', $url);

// 5) Determinar controlador y método
$controllerName  = $segments[0] ?? 'index';
$methodName      = $segments[1] ?? 'index';
$params          = array_slice($segments, 2);

// 6) Resolver clase de controlador
$controllerClass = ucfirst(strtolower($controllerName)) . 'Controller';

// 7) Verificar existencia de la clase
if (!class_exists($controllerClass)) {
    header('HTTP/1.1 404 Not Found');
    echo "Controller '{$controllerClass}' not found.";
    exit;
}

// 8) Instanciar y verificar método
$controller = new $controllerClass();
if (!method_exists($controller, $methodName)) {
    header('HTTP/1.1 404 Not Found');
    echo "Method '{$methodName}' not found in controller '{$controllerClass}'.";
    exit;
}

// 9) Ejecutar la acción
call_user_func_array([$controller, $methodName], $params);
