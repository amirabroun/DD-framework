<?php

namespace App\Models;

class Brand extends Model
{
    /**
     * One to many relation
     *
     * @return $this
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
