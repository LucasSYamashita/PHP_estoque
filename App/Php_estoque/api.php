require_once '../config/database.php';
require_once '../app/controllers/ProdutoController.php';
require_once '../app/controllers/CategoriaController.php';
require_once '../app/controllers/TabelaController.php';

$database = new Database();
$db = $database->getConnection();

$produtoController = new ProdutoController($db);
$categoriaController = new CategoriaController($db);
$tabelaController = new TabelaController($db);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET' && preg_match('/^\/produtos$/', $uri)) {
    $produtoController->listar();
} elseif ($method == 'POST' && preg_match('/^\/produtos$/', $uri)) {
    $dados = json_decode(file_get_contents("php://input"), true);
    $produtoController->criar($dados);
}

