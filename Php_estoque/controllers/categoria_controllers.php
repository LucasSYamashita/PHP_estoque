<?php
require_once '../models/categoria_model.php';


class CategoriaController
{
    private $categoria;

    public function __construct($conn)
    {
        $this->categoria = new Categoria($conn);
    }

    // Listar categorias
    public function list()
    {
        $categorias = $this->categoria->list();
        include_once '../views/categoria/list.php';
        try {
            $categorias = $this->categoria->list();
            include_once '../views/categoria/list.php'; // Incluir view para listar categorias
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao listar as categorias."]);
        }
    }

    // Criar categoria
    public function create()
    {
        include_once '../views/categoria/create.php';
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name)) {
            try {
                $this->categoria->create($data->name);
                http_response_code(201);
                echo json_encode(["message" => "Categoria criada com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar a categoria."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Editar categoria
    public function edit($id)
    {
        $categoria = $this->categoria->getById($id);
        include_once '../views/categoria/edit.php';
        if (!empty($id)) {
            try {
                $categoria = $this->categoria->getById($id);
                if ($categoria) {
                    include_once '../views/categoria/edit.php'; // Exemplo de incluir view para editar
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Categoria não encontrada."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar a categoria."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID da categoria inválido."]);
        }
    }

    // Excluir categoria
    public function delete()
    {
        $id = $_POST['id'] ?? null;

        if ($id) {
            if ($this->categoria->delete($id)) {
                header('Location: /categoria/list');
            } else {
                echo "Erro ao excluir a categoria.";
            }
        } else {
            echo "ID inválido.";
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['method']) && $_GET['method'] === 'delete') {
            // Verifica se o ID foi passado
            $id = $_POST['id'] ?? null;
    
            if ($id && is_numeric($id)) {
                // Verificar se há produtos associados à categoria
                $query = "SELECT COUNT(*) as total FROM produto WHERE id_categoria = ?";
                $stmt = $this->categoria->getConnection()->prepare($query); // Usar diretamente a conexão $conn da classe Categoria
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_assoc();
    
                if ($result['total'] > 0) {
                    // Se houver produtos associados
                    header("Location: ../views/categoria/list.php?message=Não é possível excluir a categoria. Existem produtos associados.");
                } else {
                    // Se não houver produtos, exclui a categoria
                    $deleteResult = $this->categoria->delete($id);
    
                    if ($deleteResult) {
                        header("Location: ../views/categoria/list.php?message=Categoria excluída com sucesso!");
                    } else {
                        header("Location: ../views/categoria/list.php?message=Erro ao excluir a categoria.");
                    }
                }
            } else {
                // Se não encontrar o ID ou o ID não for válido
                header("Location: ../views/categoria/list.php?message=ID da categoria inválido.");
            }
        } else {
            // Caso a requisição não seja POST ou o método não seja delete
            header("Location: ../views/categoria/list.php?message=Ação não permitida.");
        }
    }
}
?>
