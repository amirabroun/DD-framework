<?php

namespace App\Models;

use App\DataBase\DataBase;
use PDO;
use App\Helpers\ReflectionHelper;

class Model
{

    private DataBase $connected;

    protected string $table = '';

    protected array $fillable = [];

    public static function query()
    {
        $instance = new static;

        return $instance->setConnected()->setTable();
    }

    public static function create($attributes = [])
    {
        $instance = new static;

        return $instance->setConnected()->setTable()->setAttributesToObject($attributes);
    }

    public function get($column = ['*'])
    {
        $this->connected->query('SELECT ' . select($column) . " FROM $this->table");

        $attributes = $this->connected->exe()->fetchAll(PDO::FETCH_OBJ);

        return $this->setAttributesToObject($attributes);
    }

    public function first($column = ['*'])
    {
        $this->connected->query('SELECT ' . select($column) . " FROM $this->table ")->take(1);

        $attributes = $this->connected->exe()->fetch(PDO::FETCH_OBJ);

        return $this->setAttributesToObject($attributes);
    }

    public static function find($id, $select = ['*'])
    {
        return static::query()->where('id', '=', $id)->first($select);
    }

    public static function all($select = ['*'])
    {
        return static::query()->get($select);
    }

    public function where($column, $operator, $value)
    {
        $this->connected->where(" WHERE $column $operator '$value'");

        return $this;
    }

    public function andWhere($column, $operator, $value)
    {
        $this->connected->where(" AND $column $operator '$value'");

        return $this;
    }

    public function save()
    {
        $attributes = ReflectionHelper::getDynamicObjectProperties($this);

        return $this->new($attributes)->find($this->connected->exe('insert'));
    }

    private function new($attributes)
    {
        $COLUMN = "(" . implode(", ", array_keys($attributes)) . ")";

        $VALUES = "('" . implode("', '", array_values($attributes)) . "')";

        $this->connected->query("INSERT INTO `$this->table` $COLUMN VALUES $VALUES; ");

        return $this;
    }

    protected function setAttributesToObject(object|array|null $object)
    {
        if (!$object) {
            return;
        }

        foreach ((object) $object as $var => $value) {
            $this->{$var} = $value;
        }

        return $this;
    }

    private function setTable()
    {
        $this->table = getTableName($this);

        return $this;
    }

    private function setConnected()
    {
        $this->connected = new DataBase;

        return $this;
    }
}
