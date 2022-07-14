<?php

namespace App\Models;

class Product extends Model
{
    public function brand()
    {
        return $this->hasOne(Brand::class, 'brand_id');
    }
}
