<?php

namespace App\Requests;

class ProductRequest extends Request
{
    public function rules()
    {
        return [
            'title' => 'required',
            'brand_id' => '',
            'price' => 'required|number',
            'price_discounted' => 'number',
            'description' => 'required',
        ];
    }

    public function handle()
    {
        //
    }
}
