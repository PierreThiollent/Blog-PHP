<?php

namespace App;

class Helpers
{
    /**
     * Methode to generate random token
     *
     * @return string
     */
    public static function generateToken(): string
    {
        return bin2hex(openssl_random_pseudo_bytes(60));
    }
}
