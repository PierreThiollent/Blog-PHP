<?php

require_once '../vendor/autoload.php';

use App\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.local');
$dotenv->load();

$router = new Router($_GET['url']);

// Homepage route
$router->get('/', 'HomeController->index');

// Articles page
$router->get('/articles', 'ArticlesController->index');

$router->run();
