<?php
// Incluir o arquivo de modelo para a classe Produto
require_once __DIR__ . '/../../models/produto_model.php';
require_once __DIR__ . '/../../config/conexao.php';

// Criar uma instância da classe Produto
$produtoModel = new Produto($conn);

// Listar produtos
$produtos = $produtoModel->list(); // Chama o método 'list' para obter os produtos
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../../navbar.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Controle de Produtos 
                            <a href="create.php" class="btn btn-primary float-end">Adicionar Produto</a>
                            <a href="../../index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                               <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produtos as $produto): ?>
                                    <tr>
                                        <td><?= $produto['id']; ?></td>
                                        <td><?= $produto['nome']; ?></td>
                                        <td><?= $produto['preco']; ?></td>
                                        <td><?= $produto['quantidade']; ?></td>
                                        <td><?= $produto['nome_categoria']; ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $produto['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                            <form action="delete.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $produto['id']; ?>)">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        function confirmDelete(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                // Se o usuário confirmar, redireciona para a URL de exclusão com o ID
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</body>
</html>
