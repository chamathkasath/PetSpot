<?php 

require_once __DIR__ . '/config.php';

class Database
{
    public static function connect()
    {
        $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        return new PDO($dsn, DBUSER, DBPASS);
    }
}


