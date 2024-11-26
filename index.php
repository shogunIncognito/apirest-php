<?php

// Incluir el enrutador y el controlador
include_once 'router/Router.php';
include_once 'controllers/UserController.php';

// cors
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

// Crear una instancia del enrutador
$router = new Router();

// Registrar las rutas
$router->addRoute('GET', '/api/users', function () {
    $controller = new UserController();
    $controller->getAllUser();
});

$router->addRoute('GET', '/api/users/(\d+)', function ($id) {
    $controller = new UserController();
    $controller->getUserById($id);
});

$router->addRoute('POST', '/api/users/create', function () {
    $controller = new UserController();
    $controller->createUser();
});

$router->addRoute('PUT', '/api/users/(\d+)', function ($id) {
    $controller = new UserController();
    $controller->updateUser($id);
});

// Obtener el método y la URL de la solicitud
$method = $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Manejar la solicitud
$router->handleRequest($method, $url);
