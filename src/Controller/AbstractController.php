<?php

namespace App\Controller;

use App\Http\Request;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractController
{
    public function __construct(Environment $twig, Request $request, $session)
    {
        $this->twig = $twig;
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * Render twig template.
     */
    protected function render(string $template, array $data = []): string
    {
        try {
            return $this->twig->render($template, $data);
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            return $e->getMessage();
        }
    }

    /**
     * Redirect method.
     */
    public function redirect(string $path, int $http_code = 302): void
    {
        header("Location: {$path}", true, $http_code);
    }
}
