<?php

// Incluir el enrutador y el controlador
include_once 'router/Router.php';
include_once 'controllers/UserController.php';
include_once 'controllers/AuthController.php';

// cors
header("Access-Control-Allow-Origin: *"); // Permitir cualquier origen
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Crear una instancia del enrutador
$router = new Router();

include_once 'routes/routes.php';

// Obtener el método y la URL de la solicitud
$method = $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}
// Manejar la solicitud
$router->handleRequest($method, $url);
