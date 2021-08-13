<?php

namespace App\Http;


class File
{
    public function get(string $key)
    {
        return $_FILES[$key] ?? null;
    }

    public function getFileSize(string $key): int
    {
        if (array_key_exists($key, $_FILES)) {
            return $this->get($key)['size'];
        }

        return 0;
    }
}
