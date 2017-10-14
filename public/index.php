<?php

require '..\bootstrap.php';                   // gerado pelo composer modelo psr-4

use \Psr\Http\Message\ServerRequestInterface;    // Interfaces
use \Psr\Http\Message\ResponseInterface;
use Slim\App;
use Classes\Controllers\ComprasController;      // namespace

$app = new App;
$app->get('/', ComprasController::class . ':index');
$app->run();




 ?>
