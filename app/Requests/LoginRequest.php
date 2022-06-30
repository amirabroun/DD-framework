<?php

namespace App\Requests;

class LoginRequest extends Request
{

    /**
     * @return array $rules
     */
    public function rules()
    {
        return  [
            'username' => 'required',
            'password' => 'required|password'
        ];
    }

    public function handle()
    {
        includePath()->view('auth.login', [
            'error' => $this->apiResponse->message
        ]);
    }
}
