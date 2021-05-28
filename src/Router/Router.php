<?php

namespace App\Router;

use App\Controller\AbstractController;

class Router extends AbstractController
{
    private string $url;
    private array $routes = [];

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Method to instanciate a new Route and
     * add it to our array of routes
     *
     * @param string $path
     * @param \Closure|string $callable callback function
     * @return Route
     */
    public function get(string $path, \Closure|string $callable): Route
    {
        return $this->add($path, $callable, 'GET');
    }

    /**
     * Method to create a new GET route
     *
     * @param string $path
     * @param \Closure|string $callable callback function
     * @param string $method HTTP_METHOD
     * @return Route
     */
    private function add(string $path, \Closure|string $callable, string $method): Route
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;

        return $route;
    }

    /**
     * Method to create a new POST route
     *
     * @param string $path
     * @param \Closure|string $callable callback function
     * @return Route
     */
    public function post(string $path, \Closure|string $callable): Route
    {
        return $this->add($path, $callable, 'POST');
    }

    /**
     * Method to run our router
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
                return $route->call();
            }
        }

        header('HTTP/1.0 404 Not Found');

        return $this->render('404.html.twig');
    }
}
