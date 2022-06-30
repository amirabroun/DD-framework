<?php

namespace App\Requests;

use App\Helpers\ApiResponse;

class Request
{

    /**
     * @var object $post
     */
    private object $post;

    /**
     * @var object $get
     */
    private object $get;

    /**
     * @var object $request
     */
    private object $request;

    /**
     * @var ApiResponse $apiResponse
     */
    protected ApiResponse $apiResponse;

    /**
     * required|number|mobile|password|persianChar
     * 
     * @var array $rules
     */
    protected array $rules = [];

    /**
     * Set post|get|request|apiResponse
     * 
     * @return object
     */
    public function __construct(ApiResponse $apiResponse = null)
    {
        $this->post = (object)POST();
        $this->get = (object)GET();
        $this->request = (object)REQUEST();

        $this->apiResponse = $apiResponse ?? new ApiResponse();
    }

    /**
     * @return ApiResponse
     */
    public function validate(array $rules, $returnValue = null)
    {
        if (isNotEmpty($errors = validator($rules))) {
            $instance = new $this;

            $instance->apiResponse
                ->setTitle('Please correct the following errors!')
                ->setMessage($errors)
                ->setStatus(404);

            if (method_exists(get_class($instance), 'handle')) {
                $instance->handle($instance->apiResponse);
                exit;
            }
        }

        if ($returnValue == 'post') {
            return $this->post;
        }

        if ($returnValue == 'get') {
            return $this->get;
        }

        return $this->request;
    }

    /**
     * Return post|get|request
     * 
     * @return object
     */
    public function validated(string $returnValue = 'post')
    {
        return $this->validate((new $this)->rules(), $returnValue);
    }
}
