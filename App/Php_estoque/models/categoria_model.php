<?php
namespace App\Models;

class Categoria {
    private $conn;
    private $table_name = "categorias";

    public $id;
    public $nome;

    public function __construct($db) {
        $this->conn = $db;
    }
}
