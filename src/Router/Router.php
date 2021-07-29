<?php

namespace App\Router;

use App\Controller\AbstractController;
use Twig\Environment;

class Router extends AbstractController
{
    private string $url;
    private array $routes = [];
    protected Environment $twig;

    public function __construct(string $url, Environment $twig)
    {
        $this->url = $url;
        $this->twig = $twig;
    }

    /**
     * Method to instanciate a new Route and
     * add it to our array of routes.
     *
     * @param \Closure|string $callable callback function
     */
    public function get(string $path, \Closure | string $callable): Route
    {
        return $this->add($path, $callable, 'GET');
    }

    /**
     * Method to create a new GET route.
     *
     * @param \Closure|string $callable callback function
     * @param string          $method   HTTP_METHOD
     */
    private function add(string $path, \Closure | string $callable, string $method): Route
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;

        return $route;
    }

    /**
     * Method to create a new POST route.
     *
     * @param \Closure|string $callable callback function
     */
    public function post(string $path, \Closure | string $callable): Route
    {
        return $this->add($path, $callable, 'POST');
    }

    /**
     * Method to run our router.
     *
     * @throws \Exception
     */
    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            header('HTTP/1.0 404 Not Found');

            return $this->render('404.html.twig');
        }

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call($this->twig);
            }
        }

        header('HTTP/1.0 404 Not Found');

        return $this->render('404.html.twig');
    }
}
