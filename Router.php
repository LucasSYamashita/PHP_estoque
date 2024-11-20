<?php

// router.php
require_once 'PHP_estoque/config/conexao.php';
require_once 'controllers/categoria_controller.php';
require_once 'controllers/produto_controller.php';

class Router
{
    private $routes = [];

    public function add($method, $path, $callback)
    {
        $path = preg_replace('/\{(\w+)\}/', '(\w+)', $path);
        $this->routes[] = ['method' => $method, 'path' => "#^" . $path . "$#", 'callback' => $callback];
    }

    public function dispatch($requestedPath)
    {
        $requestedMethod = $_SERVER["REQUEST_METHOD"];

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && preg_match($route['path'], $requestedPath, $matches)) {
                array_shift($matches);
                return call_user_func($route['callback'], ...$matches);
            }
        }
        echo "404 - Página não encontrada";
    }
}

// Instanciando o roteador
$router = new Router();

// Definir as rotas
$router->add('GET', '/categoria/list', function() {
    $controller = new CategoriaController($conn);
    $controller->list();
});

$router->add('GET', '/categoria/create', function() {
    $controller = new CategoriaController($conn);
    $controller->create();
});

$router->add('GET', '/categoria/edit/{id}', function($id) {
    $controller = new CategoriaController($conn);
    $controller->edit($id);
});

$router->add('POST', '/categoria/delete', function() {
    $controller = new CategoriaController($conn);
    $controller->delete();
});

$router->add('GET', '/produto/list', function() {
    $controller = new ProdutoController($conn);
    $controller->list();
});

$router->add('GET', '/produto/create', function() {
    $controller = new ProdutoController($conn);
    $controller->create();
});

$router->add('GET', '/produto/edit/{id}', function($id) {
    $controller = new ProdutoController($conn);
    $controller->edit($id);
});

$router->add('POST', '/produto/delete', function() {
    $controller = new ProdutoController($conn);
    $controller->delete();
});

// Verifica a URL solicitada
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($requestUri);


?>