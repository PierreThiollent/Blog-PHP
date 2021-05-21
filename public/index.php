<?php

require_once '../vendor/autoload.php';

use App\Router\Router;

$router = new Router($_GET['url']);

// Homepage route
$router->get('/', 'HomeController->index');

$router->run();
