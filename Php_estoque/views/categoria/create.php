<?php
    
    require_once __DIR__ . '/../../config/conexao.php';
    require_once __DIR__ . '/../../models/categoria_model.php'; 



    if (isset($_POST['create_categoria'])) {
         $nome = $_POST['nome'] ?? null;

        if (!empty($nome)) {
            $categoria = new Categoria($conn);
            if ($categoria->create($nome)) {
                $message = "Categoria criada com sucesso!";
                header("Location: list.php"); 
            } else {
                $message = "Erro ao criar categoria. Tente novamente.";
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
    <title>Criar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include __DIR__ . '/../../navbar.php'; ?>
         <div class="container mt-5">
            <div class = "row">
              <div class= "col-md-12">
                <div class= "card ">
                  <div class= "card-header">
                    <h4>Adicionar categoria
                    <a href= "list.php" class="btn btn-danger float-end">Voltar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form id="model/produto_model.php" method="POST">
                        <div class="mb-3">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" required><br>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="create_categoria" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        // document.getElementById('produtoForm').addEventListener('submit', function(event) {
        //     event.preventDefault();
        //     const formData = new FormData(this);
        //     fetch('/produtos', {
        //         method: 'POST',
        //         headers: { 'Content-Type': 'application/json' },
        //         body: JSON.stringify(Object.fromEntries(formData))
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         if (data.success) window.location.href = 'list.php';
        //         else alert(data.error);
        //     });
        // });
    </script>
</body>
</html>
