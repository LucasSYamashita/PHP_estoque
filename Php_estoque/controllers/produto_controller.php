<?php
require_once '../models/produto_model.php';
require_once '../models/categoria_model.php';  // Certifique-se de incluir o model de Categoria

class ProdutoController
{
    private $produto;
    private $categoria;

    public function __construct($db)
    {
        $this->produto = new Produto($db);
        $this->categoria = new Categoria($db);
    }

    // Criar produto
    public function create()
    {
        include_once '../views/produto/create.php';
        $data = $_POST;

        if (isset($data['nome']) && isset($data['preco']) && isset($data['quantidade']) && isset($data['nome_categoria'])) {
            $categoriaId = $this->getCategoriaIdByName($data['nome_categoria']);
            if ($categoriaId) {
                $this->produto->create($data['nome'], $data['preco'], $data['quantidade'], $categoriaId);
                header("Location: list.php");
            } else {
                echo "Categoria não encontrada.";
            }
        } else {
            echo "Dados incompletos para criação do produto.";
        }
    }

    // Editar produto
    public function edit($id)
    {
        $produto = $this->produto->getById($id);
        include_once '../views/produto/edit.php';
        if (isset($id)) {
            try {
                $produto = $this->produto->getProdutoById($id);
                if ($produto) {
                    $categorias = $this->categoria->getAllCategories();
                    include_once '../views/produto/edit.php';
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Produto não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o produto."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Obter ID da categoria pelo nome
    private function getCategoriaIdByName($nome_categoria)
    {
        $categoriaInfo = $this->categoria->getByName($nome_categoria);
        return $categoriaInfo ? $categoriaInfo['id'] : null;
    }
}
