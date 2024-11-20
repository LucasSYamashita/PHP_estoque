<?php
// Incluir arquivos necessários
require_once '../../../config/conexao.php';
require_once '../../../controllers/categoria_controller.php';
require_once '/../../controllers/produto_controller.php';

// Funções de teste

// Teste de Listagem de Categorias
function testListCategories($categoriaController) {
    echo "Teste de Listagem de Categorias:\n";
    try {
        $categoriaController->list();
        echo "Listagem de categorias bem-sucedida.\n";
    } catch (Exception $e) {
        echo "Erro ao listar categorias: " . $e->getMessage() . "\n";
    }
}

// Teste de Criação de Categoria
function testCreateCategory($categoriaController) {
    echo "Teste de Criação de Categoria:\n";
    $data = json_decode('{"name": "Nova Categoria"}');
    try {
        $categoriaController->create($data);
        echo "Categoria criada com sucesso.\n";
    } catch (Exception $e) {
        echo "Erro ao criar categoria: " . $e->getMessage() . "\n";
    }
}

// Teste de Exclusão de Categoria
function testDeleteCategory($categoriaController, $id) {
    echo "Teste de Exclusão de Categoria:\n";
    try {
        $categoriaController->delete($id);
        echo "Categoria excluída com sucesso.\n";
    } catch (Exception $e) {
        echo "Erro ao excluir categoria: " . $e->getMessage() . "\n";
    }
}

// Teste de Listagem de Produtos
function testListProducts($produtoController) {
    echo "Teste de Listagem de Produtos:\n";
    try {
        $produtoController->list();
        echo "Listagem de produtos bem-sucedida.\n";
    } catch (Exception $e) {
        echo "Erro ao listar produtos: " . $e->getMessage() . "\n";
    }
}

// Teste de Criação de Produto
function testCreateProduct($produtoController) {
    echo "Teste de Criação de Produto:\n";
    $data = json_decode('{"name": "Novo Produto", "price": 100.00, "quantity": 10, "id_categoria": 1}');
    try {
        $produtoController->create($data);
        echo "Produto criado com sucesso.\n";
    } catch (Exception $e) {
        echo "Erro ao criar produto: " . $e->getMessage() . "\n";
    }
}

// Teste de Exclusão de Produto
function testDeleteProduct($produtoController, $id) {
    echo "Teste de Exclusão de Produto:\n";
    try {
        $produtoController->delete($id);
        echo "Produto excluído com sucesso.\n";
    } catch (Exception $e) {
        echo "Erro ao excluir produto: " . $e->getMessage() . "\n";
    }
}
use PHPUnit\Framework\TestCase;

class CategoriaControllerTest extends TestCase
{
    public function testCreateCategoria()
    {
        // Mock do objeto de conexão com o banco de dados
        $connMock = $this->createMock(mysqli::class);
        
        // Mock do modelo Categoria
        $categoria = $this->getMockBuilder(Categoria::class)
            ->setConstructorArgs([$connMock])
            ->onlyMethods(['create'])
            ->getMock();
        
        // Definir que o método create vai retornar sucesso
        $categoria->expects($this->once())
            ->method('create')
            ->willReturn(true);

        // Testar a criação de uma categoria
        $controller = new CategoriaController($connMock);
        $data = json_encode(['name' => 'Categoria Teste']);
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['data'] = $data;

        $controller->create();  // Chama o método de criação
        $this->expectOutputString(json_encode(["message" => "Categoria criada com sucesso."]));
    }
}

public function testCreateCategoriaValidation()
{
    // Mock da conexão
    $connMock = $this->createMock(mysqli::class);
    
    // Mock do controlador de Categoria
    $controller = $this->getMockBuilder(CategoriaController::class)
        ->setConstructorArgs([$connMock])
        ->onlyMethods(['create'])
        ->getMock();
    
    // Testar a criação com dados inválidos
    $data = json_encode(['name' => '']);
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['data'] = $data;
    
    $controller->create();
    $this->expectOutputString(json_encode(["message" => "Dados incompletos."]));
}


public function testDeleteCategoria()
{
    // Mock da conexão
    $connMock = $this->createMock(mysqli::class);
    
    // Mock do modelo Categoria
    $categoria = $this->getMockBuilder(Categoria::class)
        ->setConstructorArgs([$connMock])
        ->onlyMethods(['delete'])
        ->getMock();
    
    // Definir que o método delete vai retornar sucesso
    $categoria->expects($this->once())
        ->method('delete')
        ->willReturn(true);
    
    // Testar a exclusão
    $controller = new CategoriaController($connMock);
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['id'] = 1;  // ID de categoria para exclusão
    
    $controller->delete();
    $this->expectOutputString("Categoria excluída com sucesso!");
}
// Executar os testes

// Criar instâncias dos controladores
$categoriaController = new CategoriaController($conn);
$produtoController = new ProdutoController($conn);

// Executar os testes

// Testes de Categoria
testListCategories($categoriaController);
testCreateCategory($categoriaController);
testDeleteCategory($categoriaController, 1);  // Exemplo com ID da categoria para exclusão

// Testes de Produto
testListProducts($produtoController);
testCreateProduct($produtoController);
testDeleteProduct($produtoController, 1);  // Exemplo com ID do produto para exclusão



?>
