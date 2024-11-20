<?php
require_once __DIR__ . '../../../models/categoria_model.php';  // Inclui o arquivo da classe Categoria
require_once __DIR__ . '../../../models/produto_model.php';  // Inclui o arquivo da classe Produto
require_once __DIR__ . '../../../config/conexao.php';  // Inclui o arquivo de conexão

$categoriaModel = new Categoria($conn);
$categorias = $categoriaModel->getAllCategories(); // Recupera todas as categorias

// Verifica se o ID do produto foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cria uma instância da classe Produto e recupera os dados do produto
    $produtoModel = new Produto($conn);  // Adiciona a inicialização da instância aqui
    $produto_data = $produtoModel->getProdutoById($id);  // Recupera o produto pelo ID

    if ($produto_data) {
        // Carrega os dados do produto
        $nome_atual = $produto_data['nome'];
        $preco_atual = $produto_data['preco'];
        $quantidade_atual = $produto_data['quantidade'];
        $id_categoria_atual = $produto_data['id_categoria'];  // Alteração para pegar id_categoria
    } else {
        echo "Produto não encontrado!";
        exit;  // Interrompe a execução se o produto não for encontrado
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $id_categoria = $_POST['id_categoria'];  // Certifique-se de que é o ID

    if ($produtoModel->update($nome, $preco, $quantidade, $id_categoria, $id)) {
        header("Location: list.php");  // Redireciona para a lista
    } else {
        echo "Erro ao atualizar o produto.";
    }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../../navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Produto
                        <a href="list.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php if (isset($produto_data)): ?>
                        <form method="POST">
                        <input type="hidden" name="id" value="<?= $id; ?>" />
                        <div class="mb-3">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" value="<?= $nome_atual; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="preco">Preço:</label>
                            <input type="number" id="preco" name="preco" value="<?= $preco_atual; ?>" step="0.01" required />
                        </div>
                        <div class="mb-3">
                            <label for="quantidade">Quantidade:</label>
                            <input type="number" id="quantidade" name="quantidade" value="<?= $quantidade_atual; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="categoria">Categoria:</label>
                            <select id="categoria" name="id_categoria" required>
    <?php foreach ($categorias as $categoria): ?>
        <option value="<?= $categoria['id']; ?>" <?= $categoria['id'] == $id_categoria_atual ? 'selected' : ''; ?>>
    <?= $categoria['nome']; ?>
</option>


    <?php endforeach; ?>
</select>

                        </div>
                        <div class="mb-3">
                            <button type="submit" name="edit_produto" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>

                    <?php else: ?>
                        <p>Produto não encontrado.</p>
                    <?php endif; ?>                                               
                        </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
