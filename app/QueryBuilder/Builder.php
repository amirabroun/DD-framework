<?php

namespace App\QueryBuilder;

use App\DataBase\DataBase;
use App\Helpers\ReflectionHelper;

class Builder extends DataBase
{

    private string $column = '*';

    private string $where = '';

    private string $limit = '';

    protected string $table = '';

    public function __construct()
    {
        $this->setTable();
    }

    /**
     * @return $this
     */
    public static function table(string $tableName)
    {
        $instance = new static;

        $instance->setTable($tableName);

        return $instance;
    }

    /**
     * @return $this
     */
    public function select(array $column = ['*'])
    {
        $this->column = select($column);

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
        $exe = $this->exe(
            "SELECT " . $this->column . " FROM " . $this->table . $this->where . $this->limit
        );

        $attributes = $this->limit == " LIMIT 1" ? $exe->fetch() : $exe->fetchAll();

        return $this->setAttributesToObject($attributes);
    }

    /**
     * Build sql INSERT code
     * 
     * @return $this
     */
    public function save()
    {
        $attributes = ReflectionHelper::getDynamicObjectProperties($this);

        $COLUMN = "(" . implode(", ", array_keys($attributes)) . ")";

        $VALUES = "('" . implode("', '", array_values($attributes)) . "')";

        $this->exe(
            'INSERT INTO ' . $this->table . ' ' . $COLUMN . ' VALUES ' . $VALUES
        );

        $this->id = parent::$PDO->lastInsertId();

        return $this;
    }

    /**
     * Delete record
     * 
     * @return bool
     */
    public function delete()
    {
        return $this->exe(
            'DELETE FROM ' . $this->table . $this->where
        )->rowCount() == 1;
    }

    /**
     * @return $this
     */
    protected function setAttributesToObject(object|array|null|bool $object)
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
