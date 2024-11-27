<?php
// USERS
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

$router->addRoute('DELETE', '/api/users/(\d+)', function ($id) {
    $controller = new UserController();
    $controller->deleteUserById($id);
});

// AUTH
$router->addRoute('POST', '/api/auth/login', function () {
    $controller = new AuthController();
    $controller->AuthAdmin();
});
