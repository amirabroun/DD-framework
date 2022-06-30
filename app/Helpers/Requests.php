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
    private string $action;

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
        "$this->action"($route, $with);
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
        "$this->action"('/resources' . '/' . preparePath($path), $with);
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
        "$this->action"('/resources/Views/' . preparePath($path), $with);
    }
}
