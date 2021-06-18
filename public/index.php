<?php

require_once '../vendor/autoload.php';

session_start();

use App\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.local');
$dotenv->load();

$router = new Router($_GET['url']);

// Homepage route
$router->get('/', 'HomeController->index');

// Articles page
$router->get('/articles', 'ArticlesController->index');

// Article detail page
$router->get('/article/:id/:slug', 'ArticlesController->show');

// User resgistration
$router->get('/inscription', 'SecurityController->register');
$router->post('/inscription', 'SecurityController->register');

// User login
$router->get('/connexion', 'SecurityController->login');
$router->post('/connexion', 'SecurityController->login');

// User confirmation account
$router->get('/confirmation/:id-:token', 'SecurityController->confirmAccount');

$router->run();
