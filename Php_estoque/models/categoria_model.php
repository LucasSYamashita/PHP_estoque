<?php

class Categoria
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Função para criar uma nova categoria
    public function create($nome)
    {
        $sql = "INSERT INTO categoria (nome) VALUES (?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $nome); // Vincula o nome como string
            return $stmt->execute(); // Retorna true se a execução for bem-sucedida
        } else {
            return false; // Retorna false em caso de erro
        }
    }

    // Função para listar todas as categorias
    public function list()
    {
        $sql = "SELECT id, nome FROM categoria";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nome);

            $categories = [];
            while ($stmt->fetch()) {
                $categories[] = ['id' => $id, 'name' => $nome];
            }

            return $categories; // Retorna um array de categorias
        } else {
            return []; // Retorna um array vazio em caso de erro
        }
    }

    // Função para buscar categoria por ID
    public function getById($id)
    {
        $sql = "SELECT * FROM categoria WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Retorna uma categoria como array associativo
        } else {
            return null; // Retorna null se houver erro
        }
    }

    // Função para buscar categoria por nome
    public function getByName($nome)
    {
        $sql = "SELECT * FROM categoria WHERE nome = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('s', $nome);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Retorna a categoria encontrada ou null
        } else {
            return null; // Retorna null se houver erro
        }
    }

    // Função para buscar o nome da categoria pelo ID
    public function getNameById($id)
    {
        $sql = "SELECT nome FROM categoria WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc()['nome']; // Retorna o nome da categoria
            } else {
                return null; // Retorna null se a categoria não for encontrada
            }
        } else {
            return null; // Retorna null em caso de erro
        }
    }

    // Função para atualizar uma categoria
    public function update($id, $nome)
    {
        $sql = "UPDATE categoria SET nome = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $nome, $id);
            return $stmt->execute(); // Retorna true se a execução for bem-sucedida
        } else {
            return false; // Retorna false em caso de erro
        }
    }

    // Função para excluir uma categoria
// No modelo Categoria
public function delete($id)
{
    $sql = "DELETE FROM categoria WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows; // Retorna o número de linhas afetadas
    } else {
        return false;
    }
}


    // Função para obter todas as categorias como um array associativo
    public function getAllCategories()
    {
        $sql = "SELECT id, nome FROM categoria";
        $result = $this->conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Retorna todas as categorias como array associativo
        } else {
            return []; // Retorna um array vazio em caso de erro
        }
    }
}
