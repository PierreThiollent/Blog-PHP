<?php

require_once '../vendor/autoload.php';

use App\Config\Routes;
use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Router\Router;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

$session = new Session();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.local');
$dotenv->load();

if ($_ENV['env'] === 'prod') {
    error_reporting(0);
}

$loader = new FilesystemLoader(__DIR__ . '/../templates/');
$twig = new Environment($loader, ['debug' => true]);

$twig->addExtension(new DebugExtension());
$twig->addGlobal('session', $session);

$request = new Request();
$files = new File();

$router = new Router($request->getParam('url'), $twig, $request, $session, $files);

foreach (Routes::getRoutes() as $name => $route) {
    foreach ($route as $methode => $params) {
        $router->$methode($params['path'], "{$params['controller']}->{$params['method']}");
    }
}

echo $router->run();
