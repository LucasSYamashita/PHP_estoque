<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Categorias</title>
</head>
<body>
    <h1>Lista de Categorias</h1>
    <a href="create.php">Adicionar Nova Categoria</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="categoriasTable">
        </tbody>
    </table>

    <script>
        fetch('/categorias')
            .then(response => response.json())
            .then(data => {
                const categoriasTable = document.getElementById('categoriasTable');
                data.forEach(categoria => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${categoria.id}</td>
                        <td>${categoria.nome}</td>
                        <td>
                            <a href="edit.php?id=${categoria.id}">Editar</a>
                            <button onclick="deleteCategoria(${categoria.id})">Excluir</button>
                        </td>
                    `;
                    categoriasTable.appendChild(row);
                });
            });

        function deleteCategoria(id) {
            if (confirm('Tem certeza que deseja excluir esta categoria?')) {
                fetch(`/categorias/${id}`, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) location.reload();
                        else alert(data.error);
                    });
            }
        }
    </script>
</body>
</html>
