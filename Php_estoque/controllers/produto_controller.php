<?php
class ProdutoController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT * FROM produtos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function criar($dados) {
        $query = "INSERT INTO produtos (nome, preco, quantidade) VALUES (:nome, :preco, :quantidade)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->bindParam(":preco", $dados['preco']);
        $stmt->bindParam(":quantidade", $dados['quantidade']);
        $stmt->execute();
        echo json_encode(["mensagem" => "Produto criado com sucesso."]);
    }

    public function obter($id) {
        $query = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function atualizar($id, $dados) {
        $query = "UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->bindParam(":preco", $dados['preco']);
        $stmt->bindParam(":quantidade", $dados['quantidade']);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo json_encode(["mensagem" => "Produto atualizado com sucesso."]);
    }

    public function deletar($id) {
        $query = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo json_encode(["mensagem" => "Produto deletado com sucesso."]);
    }
}
