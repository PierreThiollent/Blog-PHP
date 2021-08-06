<?php

namespace App\Http;

class File
{
    public function get(string $key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }

        return null;
    }

    public function getFileZise(string $key): int
    {
        if (array_key_exists($key, $_SESSION)) {
            return $this->get($key)['size'];
        }

        return 0;
    }
}
