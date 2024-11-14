<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\ProdutoController;

class ProdutoControllerTest extends TestCase
{
    private $produtoController;

    protected function setUp(): void
    {
        $this->produtoController = new ProdutoController();
    }

    public function testCreateProdutoComNomeVazio()
    {
        $_POST = [
            'nome' => '',
            'preco' => 10,
            'quantidade' => 5
        ];

        ob_start();
        $this->produtoController->create();
        $output = ob_get_clean();
        $response = json_decode($output, true);

        $this->assertEquals(400, http_response_code());
        $this->assertArrayHasKey('error', $response);
        $this->assertEquals('O campo Nome é obrigatório.', $response['error']);
    }

    public function testCreateProdutoComPrecoInvalido()
    {
        $_POST = [
            'nome' => 'Produto Teste',
            'preco' => -10,
            'quantidade' => 5
        ];

        ob_start();
        $this->produtoController->create();
        $output = ob_get_clean();
        $response = json_decode($output, true);

        $this->assertEquals(400, http_response_code());
        $this->assertArrayHasKey('error', $response);
        $this->assertEquals('O campo Preço deve ser um número positivo.', $response['error']);
    }

    public function testCreateProdutoComQuantidadeInvalida()
    {
        $_POST = [
            'nome' => 'Produto Teste',
            'preco' => 10,
            'quantidade' => -5
        ];

        ob_start();
        $this->produtoController->create();
        $output = ob_get_clean();
        $response = json_decode($output, true);

        $this->assertEquals(400, http_response_code());
        $this->assertArrayHasKey('error', $response);
        $this->assertEquals('O campo Quantidade deve ser um número não negativo.', $response['error']);
    }
}
