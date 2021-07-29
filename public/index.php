<?php

require_once '../vendor/autoload.php';

session_start();

use App\Config\Routes;
use App\Router\Router;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.local');
$dotenv->load();

if ($_ENV['env'] === 'prod') {
    error_reporting(0);
}

$loader = new FilesystemLoader(__DIR__ . '/../templates/');
$twig = new Environment($loader, ['debug' => true]);
$twig->addExtension(new DebugExtension());
$twig->addGlobal('session', $_SESSION);

$router = new Router($_GET['url'], $twig);

foreach (Routes::getRoutes() as $name => $route) {
    foreach ($route as $methode => $params) {
        $router->$methode($params['path'], "{$params['controller']}->{$params['method']}");
    }
}

echo $router->run();
