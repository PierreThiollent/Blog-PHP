<?php

namespace App\Http;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function get(string $key): mixed
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }

        return null;
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }
}
