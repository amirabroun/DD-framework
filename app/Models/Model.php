<?php

namespace App\Models;

use App\DataBase\DataBase;
use PDO;

class Model
{

    private DataBase $connected;

    protected string $table = '';

    protected array $fillable = [];

    public static function query()
    {
        $instance = new static(static::class);

        $instance->connected = DataBase::connected();

        $instance->table = getTableName($instance);

        return $instance;
    }

    public function get($column = ['*'])
    {
        $this->connected->query('SELECT ' . select($column) . " FROM $this->table");

        $this->setAttributes($this->connected->exe()->fetchAll(PDO::FETCH_OBJ));

        return $this;
    }

    public function first($column = ['*'])
    {
        $this->connected->query('SELECT ' . select($column) . " FROM $this->table ")->take(1);

        $this->setAttributes($this->connected->exe()->fetch(PDO::FETCH_OBJ));

        return $this;
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

    protected function setAttributes($object)
    {
        if ($object) {
            foreach ((object) $object as $var => $value) {
                $this->{$var} = $value;
            }
        }
    }
}
