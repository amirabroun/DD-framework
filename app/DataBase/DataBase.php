<?php

namespace App\DataBase;

use PDOException;
use PDO;

class DataBase
{

    private PDO $PDO;

    private string $query = '';

    public function __construct()
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
            $this->PDO = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public static function connected()
    {
        $instance = new static;

        return $instance;
    }

    public function exe()
    {
        $exe = $this->PDO->prepare($this->query);

        $exe->execute();

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
