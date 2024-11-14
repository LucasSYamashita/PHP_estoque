<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>
</head>
<body>
    <h1>Editar Categoria</h1>
    <form id="categoriaForm">
        <input type="hidden" id="id" name="id">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <button type="submit">Salvar Alterações</button>
    </form>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const categoriaId = urlParams.get('id');

        fetch(`/categorias/${categoriaId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('id').value = data.id;
                document.getElementById('nome').value = data.nome;
            });

        document.getElementById('categoriaForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch(`/categorias/${categoriaId}`, {
                method: 'PUT',
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
