<?php

namespace App\Controllers;

use App\Helpers\ApiResponse;

class Controller
{
    protected ApiResponse $apiResponse;

    public function __construct()
    {
        $this->apiResponse = new ApiResponse();
    }

    protected function recaptchaVerify($grecaptchaToken)
    {
        return recaptchaVerify(secretKey('secret_recaptcha_key'), $grecaptchaToken);
    }
}
