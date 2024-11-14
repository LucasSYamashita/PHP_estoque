<?php
class CategoriaController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT * FROM categorias";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function criar($dados) {
        $query = "INSERT INTO categorias (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->execute();
        echo json_encode(["mensagem" => "Categoria criada com sucesso."]);
    }

    public function obter($id) {
        $query = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function atualizar($id, $dados) {
        $query = "UPDATE categorias SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo json_encode(["mensagem" => "Categoria atualizada com sucesso."]);
    }

    public function deletar($id) {
        $query = "DELETE FROM categorias WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo json_encode(["mensagem" => "Categoria deletada com sucesso."]);
    }
}
