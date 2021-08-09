<?php

namespace App\Http;

class Request
{
    private array $query;

    public function __construct()
    {
        $this->query = [
            'GET' => $_GET,
            'POST' => $_POST,
        ];
    }

    public function getParam(string $method, string $name): ?string
    {
        return $this->query[$method][$name] ?? null;
    }

    public function getParams(string $method): array
    {
        return $this->query[$method];
    }

    public function setParam(string $method, string $name, mixed $value): void
    {
        $this->query[$method][$name] = $value;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
