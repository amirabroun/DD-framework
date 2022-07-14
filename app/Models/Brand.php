<?php

namespace App\Models;

class Brand extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
