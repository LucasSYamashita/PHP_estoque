<?php

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
}

?>
