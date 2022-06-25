<?php

namespace App\Requests;

use App\Helpers\ApiResponse;

class Request
{
    public object $post;
    public object $get;
    public object $request;

    protected ApiResponse $apiResponse;

    /**
     * @var array required
     * @var array number
     * @var array mobile
     * @var array password
     * @var array persianChar
     */
    protected array $rules = [];

    public function __construct()
    {
        $this->post = (object)POST();
        $this->get = (object)GET();
        $this->request = (object)REQUEST();

        $this->apiResponse = new ApiResponse();
    }

    public function validate(array $rules, $returnValue = null)
    {
        if (isNotEmpty($errors = validator($rules))) {
            $this->apiResponse
                ->setTitle('لطفا خطاهای زیر را برطرف کنید!')
                ->setMessage($errors)
                ->setStatus(404)
                ->sweetAlert();
        }

        if ($returnValue == 'post') return $this->post;
        if ($returnValue == 'get') return $this->get;
        return $this->request;
    }
}
