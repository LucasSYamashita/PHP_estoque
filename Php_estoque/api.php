<?php

require_once __DIR__ . '/../../config/conexao.php';  // Certifique-se de que o caminho está correto
require_once __DIR__ . '/../../models/categoria_model.php';
require_once __DIR__ . '/../../models/produto_model.php';
require_once __DIR__ . '/router.php';

// O resto do código da API continua abaixo

$router = new Router();

// Categorias
$router->add('GET', '/api/categories', function() {
    global $conn;
    $categoriaModel = new Categoria($conn);
    $categories = $categoriaModel->list();
    echo json_encode($categories);
});

$router->add('GET', '/api/categories/{id}', function($id) {
    global $conn;
    $categoriaModel = new Categoria($conn);
    $category = $categoriaModel->getById($id);
    if ($category) {
        echo json_encode($category);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Category not found']);
    }
});

$router->add('POST', '/api/categories', function() {global $conn;
    $data = json_decode(file_get_contents("php://input"));
    $categoriaModel = new Categoria($conn);
    if ($categoriaModel->create($data->name)) {
        echo json_encode(['message' => 'Category created']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to create category']);
    }
});

$router->add('PUT', '/api/categories/{id}', function($id) {global $conn;
    $data = json_decode(file_get_contents("php://input"));
    $categoriaModel = new Categoria($conn);
    if ($categoriaModel->update($id, $data->name)) {
        echo json_encode(['message' => 'Category updated']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to update category']);
    }
});

$router->add('DELETE', '/api/categories/{id}', function($id) {global $conn;
    $categoriaModel = new Categoria($conn);
    if ($categoriaModel->delete($id)) {
        echo json_encode(['message' => 'Category deleted']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to delete category']);
    }
});

// Produtos
$router->add('GET', '/api/products', function() {global $conn;
    $produtoModel = new Produto($conn);
    $products = $produtoModel->list();
    echo json_encode($products);
});

$router->add('GET', '/api/products/{id}', function($id) {
    global $conn;
    $produtoModel = new Produto($conn);
    $product = $produtoModel->getById($id);
    if ($product) {
        echo json_encode($product);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Product not found']);
    }
});

$router->add('POST', '/api/products', function() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"));

    // Certifique-se de que o JSON recebido contém o campo categoria_id
    if (isset($data->name, $data->preco, $data->quantidade, $data->categoria_id)) {
        $produtoModel = new Produto($conn);
        if ($produtoModel->create($data->name, $data->preco, $data->quantidade, $data->categoria_id)) {
            echo json_encode(['message' => 'Product created']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to create product']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Missing required fields']);
    }
});


$router->add('PUT', '/api/products/{id}', function($id) {
    global $conn;
    $data = json_decode(file_get_contents("php://input"));
    $produtoModel = new Produto($conn);
    if ($produtoModel->update($id, $data->name, $data->preco, $data->quantidade)) {
        echo json_encode(['message' => 'Product updated']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to update product']);
    }
});

$router->add('DELETE', '/api/products/{id}', function($id) {
    global $conn;
    $produtoModel = new Produto($conn);
    if ($produtoModel->delete($id)) {
        echo json_encode(['message' => 'Product deleted']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to delete product']);
    }
});

$router->dispatch($_SERVER['REQUEST_URI']);
