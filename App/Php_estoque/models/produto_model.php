<?php
namespace App\Models;

class Produto {
    private $conn;
    private $table_name = "produtos";

    public $id;
    public $nome;
    public $preco;
    public $quantidade;

    public function __construct($db) {
        $this->conn = $db;
    }
}
