<?php
require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../models/produto_model.php';

// Verifica se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Instancia o modelo de produto
    $produto = new Produto($conn);
    
    // Chama o método delete para excluir o produto
    if ($produto->delete($id)) {
        // Redireciona para a página de listagem com uma mensagem de sucesso
        header('Location: list.php?message=Produto excluído com sucesso!');
    } else {
        // Redireciona com uma mensagem de erro
        header('Location: list.php?message=Erro ao excluir o produto.');
    }
    exit;
} else {
    // Se não encontrar o ID, redireciona para a lista
    header('Location: list.php?message=ID do produto não encontrado.');
    exit;
}
?>
