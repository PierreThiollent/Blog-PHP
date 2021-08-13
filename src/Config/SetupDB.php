<?php

namespace App\Config;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\DAL;

class SetupDB
{
    public static function setup(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../', '.env.local');
        $dotenv->load();

        $db = new DAL();
        $query = file_get_contents(__DIR__ . '/db.sql');

        $db->execute($query);
    }
}

SetupDB::setup();