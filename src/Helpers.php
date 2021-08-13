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

    /**
     * Method returning a slug from a string
     *
     * @param  string $string
     * @return string $slug
     */
    public static function slugify(string $string): string
    {
        return preg_replace(
            '/\s+/',
            '-',
            mb_strtolower(trim(strip_tags($string)), 'UTF-8')
        );
    }
}
