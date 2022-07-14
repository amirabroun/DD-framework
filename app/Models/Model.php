<?php

namespace App\Models;

use App\QueryBuilder\Builder;

class Model extends Builder
{
    /**
     * @var string $table
     */
    protected string $table = '';

    /**
     * @var array $fillable
     */
    protected array $fillable = [];

    /**
     * New query
     * 
     * @return $this
     */
    public static function query()
    {
        $instance = new static;

        $instance->setTable();

        return $instance;
    }

    /**
     * New record
     * 
     * @return $this
     */
    public static function create(array $attributes = [])
    {
        $instance = new static;

        $instance->setTable()->new($attributes);

        return $instance;
    }

    /**
     * Find by <int> id
     * 
     * @return $this
     */
    public static function find(int $id, array $select = ['*'])
    {
        return static::query()->where('id', '=', $id)->first($select);
    }

    /**
     * All of record
     *
     * @param array $select
     * @return $this
     */
    public static function all(array $select = ['*'])
    {
        return static::query()->get($select);
    }

    /**
     * Select 
     *
     * @param array $column
     * @return $this
     */
    public function get(array $column = ['*'])
    {
        $this->select($column);

        parent::get();

        return $this;
    }

    /**
     * Save new record
     *
     * @return $this
     */
    public function save()
    {
        $this->setTable($this);

        $this->find(parent::save()->id);

        return $this;
    }

    /**
     * Delete a record
     *
     * @return bool
     */
    public function delete()
    {
        return parent::delete();
    }

    /**
     * Get first record
     *
     * @param array $column
     * @return $this
     */
    public function first($column = ['*'])
    {
        $this->select($column)->take(1);

        parent::get();

        return $this;
    }
}
