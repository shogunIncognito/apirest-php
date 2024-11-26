<?php
class Router
{
    private $routes = [];

    // Registrar rutas
    public function addRoute($method, $route, $callback)
    {
        $this->routes[] = ['method' => $method, 'route' => $route, 'callback' => $callback];
    }

    // Manejar la ruta solicitada
    public function handleRequest($method, $url)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match("#^" . $route['route'] . "$#", $url, $matches)) {
                array_shift($matches); // Eliminar el primer elemento que es el completo
                call_user_func_array($route['callback'], $matches);
                return;
            }
        }
        // Si no hay ruta definida, se muestra un error 404
        http_response_code(404);
        echo json_encode(["error" => "Ruta no encontrada"]);
    }
}
