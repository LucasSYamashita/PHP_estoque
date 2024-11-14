<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>
    <form id="produtoForm">
        <input type="hidden" id="id" name="id">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" required><br>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria_id" required></select><br>

        <button type="submit">Salvar Alterações</button>
    </form>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const produtoId = urlParams.get('id');

        fetch(`/produtos/${produtoId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('id').value = data.id;
                document.getElementById('nome').value = data.nome;
                document.getElementById('descricao').value = data.descricao;
                document.getElementById('preco').value = data.preco;
                document.getElementById('quantidade').value = data.quantidade;

                fetch('/categorias')
                    .then(response => response.json())
                    .then(categorias => {
                        const categoriaSelect = document.getElementById('categoria');
                        categorias.forEach(categoria => {
                            const option = document.createElement('option');
                            option.value = categoria.id;
                            option.textContent = categoria.nome;
                            if (categoria.id == data.categoria_id) option.selected = true;
                            categoriaSelect.appendChild(option);
                        });
                    });
            });

        document.getElementById('produtoForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch(`/produtos/${produtoId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(Object.fromEntries(formData))
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) window.location.href = 'index.php';
                else alert(data.error);
            });
        });
    </script>
</body>
</html>
