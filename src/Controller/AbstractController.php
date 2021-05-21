<?php

namespace App\Controller;

abstract class AbstractController
{
    /**
     * Render twig template.
     */
    public function render(string $template, array $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates/');
        $twig = new \Twig\Environment($loader, ['debug' => true]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render($template, $data);
    }

    /**
     * Redirect method.
     */
    public function redirect(string $path, int $http_code = 302): void
    {
        header("Location: {$path}", true, $http_code);
    }
}
