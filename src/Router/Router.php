<?php

namespace App\Router;

class Router
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
     * @param string $method HTTP_METHOD
     */
    private function add(string $path, \Closure|string $callable, string $method): Route
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;

        return $route;
    }

    /**
     * Method to create a new GET route
     *
     * @param string $path
     * @param \Closure|string $callable callback function
     */
    public function get(string $path, \Closure|string $callable): Route
    {
        return $this->add($path, $callable, 'GET');
    }

    /**
     * Method to create a new POST route
     *
     * @param string $path
     * @param \Closure|string $callable callback function
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
            throw new \Exception('REQUEST_METHOD does not exist');
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }

       throw new \Exception('REQUEST_METHOD does not exist');
    }
}
