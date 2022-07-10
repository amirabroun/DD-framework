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
     * @return Model $this
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
     * @return Model $this
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
     * @return Model $this
     */
    public static function find(int $id, array $select = ['*'])
    {
        return static::query()->where('id', '=', $id)->first($select);
    }

    /**
     * @return Model $this
     */
    public static function all(array $select = ['*'])
    {
        return static::query()->get($select);
    }

    /**
     * @return Model $this
     */
    public function get(array $column = ['*'])
    {
        $this->select($column);

        parent::get();

        return $this;
    }

    /**
     * @return Model $this
     */
    public function save()
    {
        $this->find(parent::save()->id);

        return $this;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return parent::delete();
    }

    /**
     * @return Model $this
     */
    public function first($column = ['*'])
    {
        $this->select($column)->take(1);

        parent::get();

        return $this;
    }
}
