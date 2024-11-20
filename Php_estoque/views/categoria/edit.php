<?php
require_once __DIR__ . '/../../config/conexao.php';  // Incluindo a conexão com o banco de dados
require_once __DIR__ . '/../../models/categoria_model.php';  // Incluindo o modelo Categoria

// Verifica se o ID da categoria foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Cria uma instância da classe Categoria passando a conexão
    $categoria = new Categoria($conn);
    $categoria_data = $categoria->getById($id);

    if ($categoria_data) {
        $nome_atual = $categoria_data['nome'];
    } else {
        echo "Categoria não encontrada!";
        exit;
    }
}

// Processa o envio do formulário de edição
if (isset($_POST['edit_categoria'])) {
    $nome = $_POST['nome'] ?? null;

    if (!empty($nome)) {
        $categoria = new Categoria($conn);  // Certificando que a conexão é passada para a classe Categoria
        if ($categoria->update($id, $nome)) {
            $message = "Categoria atualizada com sucesso!";
            header("Location: list.php"); 
        } else {
            $message = "Erro ao atualizar categoria. Tente novamente.";
        }
    } else {
        $message = "O nome da categoria é obrigatório.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include __DIR__ . '/../../navbar.php'; ?>
    <div class="container mt-5">
            <div class = "row">
              <div class= "col-md-12">
                <div class= "card">
                  <div class= "card-header">
                    <h4>Editar Categoria
                    <a href= "list.php" class="btn btn-danger float-end">Voltar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" value="<?php echo $nome_atual; ?>" required><br>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="edit_categoria" class="btn btn-primary">Salvar Alterações</button>
                        </div>                      
                    </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
</body>
</html>
