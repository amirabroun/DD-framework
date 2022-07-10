<?php

namespace App\QueryBuilder;

use PDO;
use App\DataBase\DataBase;
use App\Helpers\ReflectionHelper;

class Builder
{

    private DataBase $connected;

    private string $select = '*';

    private string $where = '';

    private string $limit = '';

    protected string $table = '';

    public function __construct()
    {
        $this->setConnected()->setTable();
    }

    /**
     * @return $this
     */
    public static function table(string $tableName)
    {
        $instance = new static;

        $instance->setTable($tableName)->setConnected();

        return $instance;
    }

    /**
     * @return $this
     */
    public function select(array $column = ['*'])
    {
        $this->select = select($column);

        return $this;
    }

    /**
     * @return $this
     */
    public function where($column, $operator, $value)
    {
        $this->where = " WHERE " . $column . " " . $operator . " '$value'";

        return $this;
    }

    /**
     * @return $this
     */
    public function andWhere($column, $operator, $value)
    {
        $this->where .= " AND " . $column . " " . $operator . " '$value'";

        return $this;
    }

    /**
     * @return $this
     */
    public function orWhere($column, $operator, $value)
    {
        $this->where .= " OR " . $column . " " . $operator . " '$value'";

        return $this;
    }

    /**
     * @return $this
     */
    public function take(int $limit)
    {
        $this->limit .= " LIMIT " . $limit;

        return $this;
    }

    /**
     * @return $this
     */
    public function new($attributes = null)
    {
        $this->setAttributesToObject($attributes);

        return $this;
    }

    /**
     * Build sql SELECT code
     * 
     */
    public function get()
    {
        $query = "SELECT "
            . $this->select
            . " FROM "
            . $this->table
            . $this->where
            . $this->limit;

        $exe = $this->connected->exe($query);

        $attributes = $this->limit == " LIMIT 1" ?
            $exe->fetch(PDO::FETCH_OBJ) :
            $exe->fetchAll(PDO::FETCH_OBJ);

        return $this->setAttributesToObject($attributes);
    }

    /**
     * Build sql INSERT code
     * 
     * 
     */
    public function save()
    {
        $attributes = ReflectionHelper::getDynamicObjectProperties($this);

        $COLUMN = "(" . implode(", ", array_keys($attributes)) . ")";

        $VALUES = "('" . implode("', '", array_values($attributes)) . "')";

        $query = 'INSERT INTO '
            . $this->table . ' '
            . $COLUMN
            . ' VALUES '
            . $VALUES;

        $this->connected->exe($query);

        $this->id = DataBase::$PDO->lastInsertId();

        return $this;
    }

    /**
     * @return $this
     */
    protected function setConnected()
    {
        $this->connected = new DataBase;

        return $this;
    }

    /**
     * @return $this
     */
    protected function setAttributesToObject(object|array|null $object)
    {
        if (!$object) {
            return $this;
        }

        foreach ((object) $object as $var => $value) {
            $this->{$var} = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function setTable($tableOrModel = null)
    {
        $this->table = getTableName($tableOrModel ?? $this);

        return $this;
    }
}
