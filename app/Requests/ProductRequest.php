<?php

namespace App\Requests;

class ProductRequest extends Request
{
    protected array $rules = [
        'title' => 'required',
        'brand_id' => '',
        'price' => 'required|number',
        'price_discounted' => 'number',
        'description' => 'required',
    ];
    
    public function validated(array $rules = null, string $returnValue = 'post')
    {
        if (isNotEmpty($rules))
            return $this->validate($rules, $returnValue);

        return $this->validate($this->rules, $returnValue);
    }
}
