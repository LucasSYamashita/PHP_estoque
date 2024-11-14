<!-- src/views/produtos/list.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <a href="create.php">Adicionar Novo Produto</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="produtosTable">
            <!-- Os produtos serão carregados aqui via JavaScript -->
        </tbody>
    </table>

    <script>
        // Carregar produtos
        fetch('/produtos')
            .then(response => response.json())
            .then(data => {
                const produtosTable = document.getElementById('produtosTable');
                data.forEach(produto => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${produto.id}</td>
                        <td>${produto.nome}</td>
                        <td>${produto.preco}</td>
                        <td>${produto.quantidade}</td>
                        <td>
                            <a href="details.php?id=${produto.id}">Ver</a>
                            <a href="edit.php?id=${produto.id}">Editar</a>
                            <button onclick="deleteProduto(${produto.id})">Excluir</button>
                        </td>
                    `;
                    produtosTable.appendChild(row);
                });
            });

        // Função para excluir um produto
        function deleteProduto(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                fetch(`/produtos/${id}`, { method: 'DELETE' })
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