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
        $this->where = " WHERE " . $this->table . '.' . $column . " " . $operator . " '$value'";

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

    public function update()
    {
        $attributes = ReflectionHelper::getDynamicObjectProperties($this);

        $this->exe(
            'UPDATE ' . $this->table . ' SET ' . setValuseToColumn($attributes) . $this->where
        );

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
        !($this->table == '') ?: $this->table = getTableName($tableOrModel ?? $this);

        return $this;
    }

    /**
     * One to many
     *
     * @param string $model
     * @param string $relation_id
     * @return $this
     */
    protected function hasMany(string $model, string $relation_id)
    {
        $relation = getTableName($model);

        $exe = $this->exe(
            "SELECT " . $relation . ".*" . " FROM " . "`$this->table`" .
                " LEFT JOIN " . $relation . " ON " .
                $relation . "." . $relation_id . " = " . $this->table . ".id " .
                $this->where
        );

        return $this->setAttributesToObject($exe->fetchAll());
    }
}
