<?php

namespace App\DataBase;

use PDOException;
use PDO;

class DataBase
{

    protected static PDO $PDO;

    public static function connected()
    {
        $host = getenv("DB_HOST");
        $port = getenv("DB_PORT");
        $database = getenv("DATABASE");
        $username = getenv('USERNAME');
        $password = getenv('PASSWORD');
        $charset = getenv('CHARSET');
        $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=$charset";

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            static::$PDO = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public function exe(string $query)
    {
        $exe = static::$PDO->query($query, PDO::FETCH_OBJ);

        return $exe;
    }
}
