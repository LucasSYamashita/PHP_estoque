<?php
require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../models/categoria_model.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    $categoria = new Categoria($conn);

    // Verifica se há produtos associados a essa categoria antes de excluir
    $query = "SELECT COUNT(*) as total FROM produto WHERE id_categoria = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result['total'] > 0) {
        // Se houver produtos associados, não permite a exclusão
        header("Location: list.php?message=Não é possível excluir a categoria. Existem produtos associados.");
    } else {
        // Se não houver produtos, exclui a categoria
        $deleteResult = $categoria->delete($id);

        if ($deleteResult) {
            header("Location: list.php?message=Categoria excluída com sucesso!");
        } else {
            header("Location: list.php?message=Erro ao excluir a categoria.");
        }
    }
} else {
    header("Location: list.php?message=ID da categoria inválido.");
}
?>
