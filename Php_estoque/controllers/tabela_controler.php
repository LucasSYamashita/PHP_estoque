<?php
class TabelaController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarTabelas() {
        $query = "SHOW TABLES";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public function obterDetalhesTabela($tabela) {
        $query = "DESCRIBE " . $tabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function executarQuery($query) {
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            echo json_encode(["mensagem" => "Query executada com sucesso."]);
        } else {
            echo json_encode(["mensagem" => "Erro ao executar a query."]);
        }
    }
}
