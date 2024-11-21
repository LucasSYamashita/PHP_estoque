# Sistema de Controle de Estoque em PHP
Este é um projeto simples de controle de estoque desenvolvido em PHP, utilizando MySQL como banco de dados. O sistema permite gerenciar produtos e categorias, com a possibilidade de adicionar, editar, excluir e listar essas entidades.

# Funcionalidades
## Gerenciamento de Categorias:
 - Adicionar;
  - editar;
 - excluir; 
- listar categorias.
## Gerenciamento de Produtos:
- Adicionar;
- editar;
- excluir;
- listar produtos.
## Validações de Entrada:
- A API valida os dados enviados, garantindo que todas as informações necessárias sejam fornecidas.
Mensagens de Erro e Sucesso: O sistema fornece feedback para o usuário, informando se a operação foi bem-sucedida ou se ocorreu um erro.
# Tecnologias
- PHP (versão 7.4 ou superior)
- MySQL
- Apache (requerido para rodar o servidor local)
- Composer 
(para gerenciar dependências PHP, se necessário)
##PHPUnit
 (para testes unitários)
# Requisitos
- PHP 7.4+;
- MySQL; 
- Servidor Apache (usando XAMPP)
- Composer 
# Instalação
1. Clonar o Repositório
- Clone este repositório para a sua máquina local:

## bash
Copiar código
- git clone https://github.com/seu-usuario/estoque.git

2. Configurar o Banco de Dados
- Crie um banco de dados no MySQL e importe as tabelas necessárias.

- Crie um banco de dados banco_dos_bancos ou altere em config/conexao.php.
- Execute o script SQL contido no arquivo config/db.sql (ou similar) para criar as tabelas.
3. Configuração do Arquivo de Conexão
- No arquivo config/conexao.php, configure as credenciais de conexão com o banco de dados:

- php
Copiar código
define('DB_HOST', 'localhost');
define('DB_USER', 'seu_usuario');
define('DB_PASS', 'sua_senha');
define('DB_NAME', 'estoque');
4. Instalar Dependências 
- Se estiver utilizando o Composer para gerenciar dependências (por exemplo, PHPUnit para testes), instale as dependências:

- bash
Copiar código
composer install
5. Rodar o Servidor
- Inicie o servidor Apache (ou use o XAMPP) e acesse o sistema no navegador:

- bash
Copiar código
http://localhost/PHP_estoque/Php_estoque
# Endpoints da API
- A API possui os seguintes endpoints:

## Categorias
-GET /categoria - Lista todas as categorias.
-POST /categoria - Cria uma nova categoria.
-PUT /categoria/{id} - Atualiza uma categoria existente.
-DELETE /categoria/{id} - Exclui uma categoria.
-Produtos
-GET /produto - Lista todos os produtos.
-POST /produto - Cria um novo produto.
-PUT /produto/{id} - Atualiza um produto existente.
-DELETE /produto/{id} - Exclui um produto.
-Formato de Resposta: Todos os endpoints retornam um JSON com a resposta, contendo uma mensagem de sucesso ou erro.

# Testes
- O sistema utiliza PHPUnit para testes unitários da API. Para rodar os testes:

## Instale o PHPUnit:
- bash
Copiar código
composer require --dev phpunit/phpunit
- Execute os testes:
bash
Copiar código
./vendor/bin/phpunit --testdox tests
# Exemplos de Testes
Os testes incluem casos como:

- Criação de Categoria: Testa se a criação de uma categoria retorna o resultado esperado.
- Validação de Dados: Testa se os dados necessários para criar ou editar uma categoria estão completos.
- Exclusão de Categoria: Testa a exclusão de uma categoria, considerando se há produtos associados a ela.
- Usabilidade e Interface
- A interface do sistema foi projetada para ser simples e fácil de usar. Alguns pontos importantes:

- Fluxo de navegação: Ao criar ou editar categorias e produtos, as mudanças são refletidas na lista de itens.
- Mensagens de sucesso/erro: Após realizar ações como criar ou excluir, o sistema exibe uma mensagem informando se a operação foi bem-sucedida ou se ocorreu um erro.
- Validação de formulários: O sistema valida os formulários para garantir que os campos necessários sejam preenchidos antes de realizar a operação.
## Documentação da API
-  API retorna respostas no formato JSON, com informações sobre a operação realizada (sucesso ou erro).

## Exemplos de Respostas:
- Resposta de Sucesso:

json
Copiar código
{
    "message": "Categoria criada com sucesso."
}
Resposta de Erro:

json
Copiar código
{
    "message": "Dados incompletos."
}
# Considerações Finais
Este é um sistema básico de controle de estoque, com funcionalidades de gerenciamento de categorias e produtos. Ele pode ser expandido com mais recursos, como autenticação de usuários, controle de estoque em tempo real, entre outros.

