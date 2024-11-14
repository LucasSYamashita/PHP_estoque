<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\CategoriaController;

class CategoriaControllerTest extends TestCase
{
    private $categoriaController;

    protected function setUp(): void
    {
        $this->categoriaController = new CategoriaController();
    }

    public function testCreateCategoriaComNomeVazio()
    {
        $_POST = [
            'nome' => '' 
        ];

        ob_start();
        $this->categoriaController->create();
        $output = ob_get_clean();
        $response = json_decode($output, true);

        $this->assertEquals(400, http_response_code());
        $this->assertArrayHasKey('error', $response);
        $this->assertEquals('O campo Nome é obrigatório.', $response['error']);
    }

    public function testCreateCategoriaComNomeValido()
    {
        $_POST = [
            'nome' => 'Categoria Teste' 
        ];

        ob_start();
        $this->categoriaController->create();
        $output = ob_get_clean();
        $response = json_decode($output, true);

        $this->assertEquals(200, http_response_code());
        $this->assertArrayHasKey('success', $response);
        $this->assertTrue($response['success']);
    }

    public function testUpdateCategoriaComNomeVazio()
    {
        $_POST = [
            'nome' => '' 
        ];
        $categoriaId = 1;

        ob_start();
        $this->categoriaController->update($categoriaId);
        $output = ob_get_clean();
        $response = json_decode($output, true);

        $this->assertEquals(400, http_response_code());
        $this->assertArrayHasKey('error', $response);
        $this->assertEquals('O campo Nome é obrigatório.', $response['error']);
    }

    public function testUpdateCategoriaComNomeValido()
    {
        $_POST = [
            'nome' => 'Nova Categoria Teste' 
        ];
        $categoriaId = 1;

        ob_start();
        $this->categoriaController->update($categoriaId);
        $output = ob_get_clean();
        $response = json_decode($output, true);

        $this->assertEquals(200, http_response_code());
        $this->assertArrayHasKey('success', $response);
        $this->assertTrue($response['success']);
    }
}
