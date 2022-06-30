<?php

namespace App\Controllers;

use App\Helpers\ApiResponse;

class Controller
{

    /**
     * @var ApiResponse $apiResponse
     */
    protected ApiResponse $apiResponse;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->apiResponse = new ApiResponse();
    }

    /**
     * @param string $grecaptchaToken
     * @return bool 
     */
    protected function recaptchaVerify($grecaptchaToken)
    {
        return recaptchaVerify(secretKey('secret_recaptcha_key'), $grecaptchaToken);
    }
}
