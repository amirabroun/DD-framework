<?php

namespace App\Models;

use App\DataBase\DataBase;
use PDO;
use PDOStatement;

class Model
{
    protected array $fillable = [];
    
    private PDOStatement $sql;
    private PDO $action;

    public function __construct($sql)
    {
        $this->sql = self::prepareSQL($sql);
    }

    public static function prepareSQL($sql)
    {
        return (new DataBase)->cn->prepare($sql);
    }

    public function bindValue($values)
    {
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                $this->sql->bindValue($key + 1, $value);
            }
        } else {
            $this->sql->bindValue(1, $values);
        }
    }

    public function execute($values = null)
    {
        if ($values) {
            $this->bindValue($values);
        }

        return $this->sql->execute();
    }

    public function rowCount()
    {
        return $this->sql->rowCount();
    }

    public function fetchObject()
    {
        return $this->sql->fetch(PDO::FETCH_OBJ);
    }

    public function fetchAllObject()
    {
        return $this->sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetchArray()
    {
        return $this->sql->fetch(PDO::FETCH_ASSOC);
    }

    public function lastInsertId()
    {
        return $this->action->lastInsertId();
    }
}
