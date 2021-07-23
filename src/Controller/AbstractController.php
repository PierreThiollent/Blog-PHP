<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractController
{
    protected Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Render twig template.
     */
    public function render(string $template, array $data = [])
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
