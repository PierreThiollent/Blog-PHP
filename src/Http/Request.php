<?php

namespace App\Http;

class Request
{
    protected array $query;

    public function __construct()
    {
        $this->query = [
            'GET'  => $_GET,
            'POST' => $_POST,
        ];
    }

    /**
     * Get GET param by name.
     */
    public function getParam(string $name): ?string
    {
        return $this->query['GET'][$name] ?? null;
    }

    /**
     * GET params.
     */
    public function getParams(): array
    {
        return $this->query['GET'];
    }

    /**
     * Get POST data by name.
     */
    public function getPostParam(string $name): ?string
    {
        return $this->query['POST'][$name] ?? null;
    }

    /**
     * Get POST datas.
     */
    public function getPostParams(): array
    {
        return $this->query['POST'];
    }

    public function setParam(string $name, string $value): void
    {
        $this->query['GET'][$name] = $value;
    }

    public function setPostParam(string $name, mixed $value): void
    {
        $this->query['POST'][$name] = $value;
    }
}
