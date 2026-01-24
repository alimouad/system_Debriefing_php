<?php


use Core\Router\Router;

session_start();

// require_once __DIR__ . '/../bootstrap/autoload.php';

require __DIR__ ."/../vendor/autoload.php";



$router = new Router();

require_once __DIR__ . '/../Routes/web.php';

$router->dispatch();