<?php
require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../models/categoria_model.php';

// Instancia o modelo de categoria
$categoriaModel = new Categoria($conn);
$categorias = $categoriaModel->list();

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../../navbar.php'; ?>

    <div class="container mt-4">
        <!-- Exibir mensagens, se houver -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Controle de Categorias
                            <a href="create.php" class="btn btn-primary float-end">Adicionar Categoria</a>
                            <a href="../../index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categorias as $categoria): ?>
                                    <tr>
                                        <td><?php echo $categoria['id']; ?></td>
                                        <td><?php echo $categoria['name']; ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $categoria['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                            <form action="delete.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $categoria['id']; ?>)">Excluir</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function confirmDelete(id) {
        if (confirm('Tem certeza que deseja excluir esta categoria?')) {
            // Se o usuário confirmar, redireciona para a URL de exclusão com o ID
            window.location.href = 'delete.php?id=' + id;
        }
    }
</script>
</body>
</html>
