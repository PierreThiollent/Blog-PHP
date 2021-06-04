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
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        return substr(str_shuffle(str_repeat($chars, 60)), 0, 60);
    }
}
