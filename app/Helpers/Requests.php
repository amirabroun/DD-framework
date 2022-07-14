<?php

namespace App\Helpers;

class Requests
{
    /**
     * @var array $with
     */
    protected $with = [];

    /**
     * @var string $action
     */
    protected string $action;

    /**
     * @param string $action
     * @return void
     */
    public function __construct($action = null)
    {
        $this->action = $action;
    }

    /**
     * Action to route
     * 
     * @param string $route
     * @param array $with
     * @return void
     */
    public function route($route, array $with = [])
    {
        call_user_func($this->action, $route, $with);
    }

    /**
     * Action to resource
     * 
     * @param string $path
     * @param array $with
     * @return void
     */
    public function resource($path, array $with = [])
    {
        $path = '/resources/' . preparePath($path);

        call_user_func($this->action, $path, $with);
    }

    /**
     * Action to view
     * 
     * @param string $path
     * @param array $with
     * @return void
     */
    public function view($path, array $with = [])
    {
        $path = '/resources/Views/' . preparePath($path);

        call_user_func($this->action, $path, $with);
    }
}
