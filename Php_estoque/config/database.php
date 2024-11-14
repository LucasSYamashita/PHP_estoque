<?php
class Database {
    private $host = "localhost";
    private $db_name = "banco_de_bancos";
    private $username = "LucasSYamashita";
    private $password = "1234";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro na conexão com o banco de dados: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
