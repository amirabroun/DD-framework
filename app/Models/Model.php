<?php

namespace App\Models;

use App\DataBase\DataBase;

class Model
{

    protected array $fillable = [];

    protected string $table = '';

    protected string $query = '';

    protected \PDO $PDO;

    public function __construct()
    {
        $this->PDO = (new DataBase)->getConnected();
    }

    public static function query()
    {
        $instance = new static;

        $instance->table = $instance->getTableName($instance);

        return $instance;
    }

    public function where($column, $op, $value)
    {
        $this->query .=  "where $column $op $value";

        return $this;
    }

    public function get($column = ['*'])
    {
        $selected = '';

        foreach ($column as $c) {
            $selected .= "$c|";
        }

        $selected = str_replace('|', ', ', trim($selected, '|'));

        $this->query = "SELECT $selected From `$this->table` " . $this->query . ';';

        return $this;
    }

    private function getTableName($model)
    {
        $table = pluralize(strtolower(substr(strrchr(get_class($model), "\\"), 1)));

        return $table;
    }
}
