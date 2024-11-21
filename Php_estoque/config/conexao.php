<?php
$host = "127.0.0.1";
$bancodedados = "banco_dos_bancos";
$usuario = "root";
$senha = "";

$conn = new mysqli("$host","$usuario","$senha","$bancodedados");
if ($conn->connect_error) {
    echo"Falha ao conectar: (". $conn->connect_errno .")". $conn->connect_error;
}


// $database = mysqli_connect(Host,USUARIO, Password, DB) or die('Nao foi possivel conectar');



// class Database {
//     private $host = "localhost";
//     private $db_name = "banco_de_bancos";
//     private $username = "root";
//     private $password = "";
//     public $conn;

//     public function getConnection() {
//         $this->conn = null;
//         try {
//             $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
//             $this->conn->exec("set names utf8");
//         } catch(PDOException $exception) {
//             echo "Erro na conexão com o banco de dados: " . $exception->getMessage();
//         }
//         return $this->conn;
//     }
// }

?>
