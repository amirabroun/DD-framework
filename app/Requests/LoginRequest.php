<?php

namespace App\Requests;

class LoginRequest extends Request
{
    protected array $rules = [
        'username' => 'required',
        'password' => 'required|password'
    ];

    public function validated(array $rules = null, string $returnValue = 'post')
    {
        return isNotEmpty($rules)
            ? $this->validate($rules, $returnValue)
            : $this->validate($this->rules, $returnValue);
    }
}
