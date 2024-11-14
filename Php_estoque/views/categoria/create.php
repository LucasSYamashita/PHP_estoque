<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Categoria</title>
</head>
<body>
    <h1>Adicionar Categoria</h1>
    <form id="categoriaForm">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <button type="submit">Salvar Categoria</button>
    </form>

    <script>
        document.getElementById('categoriaForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('/categorias', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(Object.fromEntries(formData))
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) window.location.href = 'list.php';
                else alert(data.error);
            });
        });
    </script>
</body>
</html>
