<?php
// Configurações de erro
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'banco_dos_bancoss'); // Altere conforme suas configurações de banco de dados

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para gerar dados aleatórios
function gerarDadosAleatorios() {
    $nomes = ['Produto A', 'Produto B', 'Produto C', 'Produto D'];
    $precos = [10.99, 20.99, 30.99, 40.99];
    $quantidades = [10, 20, 30, 40];
    $categorias = [1, 2, 3]; // Assumindo que as categorias existem no banco

    $nome = $nomes[array_rand($nomes)];
    $preco = $precos[array_rand($precos)];
    $quantidade = $quantidades[array_rand($quantidades)];
    $id_categoria = $categorias[array_rand($categorias)];

    return [$nome, $preco, $quantidade, $id_categoria];
}

// Inserir dados aleatórios
if (isset($_POST['insert'])) {
    list($nome, $preco, $quantidade, $id_categoria) = gerarDadosAleatorios();

    $sql = "INSERT INTO produto (nome, preco, quantidade, id_categoria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $nome, $preco, $quantidade, $id_categoria);

    if ($stmt->execute()) {
        echo "Produto inserido com sucesso!";
    } else {
        echo "Erro ao inserir o produto: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Produto Aleatório</title>
</head>
<body>

<h2>Testar Inserção de Produto Aleatório</h2>

<!-- Formulário para inserção -->
<form method="POST">
    <button type="submit" name="insert">Inserir Produto Aleatório</button>
</form>

</body>
</html>

<?php
$conn->close();
?>
