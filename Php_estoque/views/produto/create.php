<?php

require_once __DIR__ . '/../../models/produto_model.php';
require_once __DIR__ . '/../../models/categoria_model.php';
require_once __DIR__ . '/../../config/conexao.php';

// Instanciando os modelos
$produtoModel = new Produto($conn);
$categoriaModel = new Categoria($conn);

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $nome_categoria = $_POST['nome_categoria'];

    // Obtém o ID da categoria baseado no nome selecionado
    $categoria = $categoriaModel->getByName($nome_categoria);  // Método para buscar categoria pelo nome
    $id_categoria = $categoria ? $categoria['id'] : null;

    // Verifica se a categoria existe
    if ($id_categoria) {
        // Chama a função de criação do produto
        $produtoModel->create($nome, $preco, $quantidade, $id_categoria);
        header("Location: list.php");  // Redireciona após salvar
    } else {
        echo "Categoria não encontrada.";
    }
}

// Obtendo categorias usando o modelo Categoria
$categorias = $categoriaModel->getAllCategories();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../../navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar Produto
                        <a href="list.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST"> <!-- Mudamos o action para enviar para o mesmo arquivo -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Produto</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="preco" class="form-label">Preço</label>
                                <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                            </div>
                            <div class="mb-3">
                                <label for="nome_categoria" class="form-label">Categoria</label>

                                <select class="form-control" id="nome_categoria" name="nome_categoria" required>
                                    <option value="">Selecione uma categoria</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?=$categoria['nome']; ?>"><?= $categoria['nome']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
