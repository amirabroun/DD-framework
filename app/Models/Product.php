<?php

namespace App\Models;

class Product extends Model
{
    /**
     * One to one relation
     *
     * @return $this
     */
    public function brand()
    {
        return $this->hasOne(Brand::class, 'brand_id');
    }
}
