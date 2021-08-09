<?php

namespace App\Router;

use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use Twig\Environment;

class Router
{
    private array $routes = [];

    public function __construct(
        private string $url,
        private Environment $twig,
        private Request $request,
        private Session $session,
        private File $files
    ) {
    }

    /**
     * Method to instanciate a new Route and
     * add it to our array of routes.
     *
     * @param \Closure|string $callable callback function
     */
    public function get(string $path, \Closure|string $callable): Route
    {
        return $this->add($path, $callable, 'GET');
    }

    /**
     * Method to create a new POST route.
     *
     * @param \Closure|string $callable callback function
     */
    public function post(string $path, \Closure|string $callable): Route
    {
        return $this->add($path, $callable, 'POST');
    }

    /**
     * Method to create a new GET route.
     *
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
     * Method to run our router.
     */
    public function run()
    {
        if (!isset($this->routes[$this->request->getMethod()])) {
            header('HTTP/1.0 404 Not Found');

            return $this->twig->render('404.html.twig');
        }

        foreach ($this->routes[$this->request->getMethod()] as $route) {
            if ($route->match($this->url)) {
                return $route->call($this->twig, $this->request, $this->session, $this->files);
            }
        }

        header('HTTP/1.0 404 Not Found');

        return $this->twig->render('404.html.twig');
    }
}
