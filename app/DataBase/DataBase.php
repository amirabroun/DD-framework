<?php

namespace App\DataBase;

use PDOException;
use PDO;

class DataBase
{

    public static PDO $PDO;

    private string $query = '';

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

    public function exe($queryType = 'select')
    {
        $exe = static::$PDO->prepare($this->query);

        $exe->execute();

        if ($queryType == 'insert') {
            return static::$PDO->lastInsertId();
        }

        return $exe;
    }

    public function query(string $query = '')
    {
        $this->query = $query . $this->query;

        return $this;
    }

    public function where(string $query)
    {
        $this->query .= $query;

        return $this;
    }

    public function take(int $limit)
    {
        $this->query .= " LIMIT $limit";

        return $this;
    }
}
