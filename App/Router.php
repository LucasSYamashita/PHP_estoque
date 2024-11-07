<?php
class Router {
    private $db;
    private $produtoController;
    private $categoriaController;

    public function __construct() {
        // Criar conexão com o banco de dados
        $this->db = (new Database())->getConnection();
        // Inicializar controladores
        $this->produtoController = new ProdutoController($this->db);
        $this->categoriaController = new CategoriaController($this->db);
    }

    public function handleRequest() {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // Rotas para o CRUD de Produtos
        if ($method === 'GET' && preg_match('/^\/produtos$/', $uri)) {
            $this->produtoController->listar();
        } elseif ($method === 'POST' && preg_match('/^\/produtos$/', $uri)) {
            $dados = json_decode(file_get_contents("php://input"), true);
            $this->produtoController->criar($dados);
        } elseif ($method === 'GET' && preg_match('/^\/produtos\/(\d+)$/', $uri, $matches)) {
            $this->produtoController->obter($matches[1]);
        } elseif ($method === 'PUT' && preg_match('/^\/produtos\/(\d+)$/', $uri, $matches)) {
            $dados = json_decode(file_get_contents("php://input"), true);
            $this->produtoController->atualizar($matches[1], $dados);
        } elseif ($method === 'DELETE' && preg_match('/^\/produtos\/(\d+)$/', $uri, $matches)) {
            $this->produtoController->deletar($matches[1]);
        }

        // Rotas para o CRUD de Categorias
        elseif ($method === 'GET' && preg_match('/^\/categorias$/', $uri)) {
            $this->categoriaController->listar();
        } elseif ($method === 'POST' && preg_match('/^\/categorias$/', $uri)) {
            $dados = json_decode(file_get_contents("php://input"), true);
            $this->categoriaController->criar($dados);
        } elseif ($method === 'GET' && preg_match('/^\/categorias\/(\d+)$/', $uri, $matches)) {
            $this->categoriaController->obter($matches[1]);
        } elseif ($method === 'PUT' && preg_match('/^\/categorias\/(\d+)$/', $uri, $matches)) {
            $dados = json_decode(file_get_contents("php://input"), true);
            $this->categoriaController->atualizar($matches[1], $dados);
        } elseif ($method === 'DELETE' && preg_match('/^\/categorias\/(\d+)$/', $uri, $matches)) {
            $this->categoriaController->deletar($matches[1]);
        } else {
            http_response_code(404);
            echo json_encode(["mensagem" => "Rota não encontrada."]);
        }
    }
}
