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
        return isNotEmpty($rules)
            ? $this->validate($rules, $returnValue)
            : $this->validate($this->rules, $returnValue);
    }
}
