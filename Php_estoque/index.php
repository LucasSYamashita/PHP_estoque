<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require '../vendor/autoload.php';


use App\Config\Database;
use App\Router;


$database = new Database();
$db = $database->getConnection();


$router = new Router($db);


$router->handleRequest();
