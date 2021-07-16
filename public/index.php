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

$router->get('/mon-compte', 'DashboardController->index');
$router->post('/mon-compte', 'DashboardController->index');

// Deconnexion
$router->get('/deconnexion', 'SecurityController->logout');

// User confirmation account
$router->get('/confirmation/:id-:token', 'SecurityController->confirmAccount');

// Add comment
$router->post('/add-comment', 'CommentsController->new');

// Add article
$router->get('/admin/new-article', 'ArticlesController->new');
$router->post('/admin/new-article', 'ArticlesController->new');

// Manage articles
$router->get('/admin/list-articles', 'ArticlesController->manageArticles');

// Delete article
$router->post('/admin/delete-article', 'ArticlesController->deleteArticle');

$router->run();
