<?php
session_start();
//require_once 'Router.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include ('navbar.php') ?>
         <div class="container mt-4">
          <?php include('models/menssagem_model.php') ?>
            <div class = "row">
              <div class= "col-md-12">
                <div class= "card ">
                  <div class= "card-header">
                      <h1 class="text-center">Bem-vindo ao Controle de Estoque</h1>
                        <div class="d-flex justify-content-center mt-4">
                        <!-- Link para Gerenciar Categorias -->
                        <a href="views/categoria/list.php" class="btn btn-primary mx-2">
                          Gerenciar Categorias
                        </a>
                        <!-- Link para Gerenciar Produtos -->
                        <a href="views/produto/list.php" class="btn btn-primary mx-2">
                          Gerenciar Produtos
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
            </div> 
         </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<!--
require_once __DIR__ . '/../../config/database.php';
-->
