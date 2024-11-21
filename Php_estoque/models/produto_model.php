<?php
class Produto
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Criar produto
    public function create($nome, $preco, $quantidade, $id_categoria)
    {
        $sql = "INSERT INTO produto (nome, preco, quantidade, id_categoria) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdii", $nome, $preco, $quantidade, $id_categoria);  // Bind de parâmetros
        return $stmt->execute();
    }

    // Listar produtos (com nome da categoria associada)
    public function list()
    {
        $sql = "SELECT p.id, p.nome, p.preco, p.quantidade, c.nome AS nome_categoria
                FROM produto p
                LEFT JOIN categoria c ON p.id_categoria = c.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
    
        // Prepara as variáveis para armazenar os dados
        $stmt->bind_result($id, $nome, $preco, $quantidade, $nome_categoria);
    
        $produtos = [];
        while ($stmt->fetch()) {
            $produtos[] = [
                'id' => $id,
                'nome' => $nome,
                'preco' => $preco,
                'quantidade' => $quantidade,
                'nome_categoria' => $nome_categoria
            ];
        }
    
        return $produtos;
    }

    // Buscar produto por ID (com nome da categoria associada)
    public function getProdutoById($id)
    {
        $sql = "SELECT p.id, p.nome, p.preco, p.quantidade, p.id_categoria, c.nome AS ids_categoria
                FROM produto p
                LEFT JOIN categoria c ON p.id_categoria = c.id
                WHERE p.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Deve retornar 'id_categoria'
    }
    
    // Obter todas as categorias
    public function getAllCategories()
    {
        $sql = "SELECT id, nome FROM categoria";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $categorias = [];
        $stmt->bind_result($id, $nome); // Associar os resultados

        while ($stmt->fetch()) {
            $categorias[] = [
                'id' => $id,
                'nome' => $nome
            ];
        }

        return $categorias;
    }
    public function update($nome, $preco, $quantidade, $id_categoria, $id) {
        $sql = "UPDATE produto SET nome = ?, preco = ?, quantidade = ?, id_categoria = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdiii', $nome, $preco, $quantidade, $id_categoria, $id);
        return $stmt->execute();
    }

    // Deletar produto
    public function delete($id)
    {
        
        $sql = "DELETE FROM produto WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->affected_rows; // Retorna o número de linhas afetadas
        } else {
            return false;
        }
    }
}
?>
