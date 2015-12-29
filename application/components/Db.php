<?php

class Db
{
    public static function connect()
    {
        $param = include(ROOT . '/application/config/db_config.php');
        extract($param);

        $dsn = sprintf("mysql:dbname=%s;host=%s", $dbname, $host);
        $pdo = new PDO($dsn, $user, $password);

        return $pdo;
    }
}