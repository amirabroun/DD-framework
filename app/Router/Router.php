<?php

namespace App\Router;

use App\Provider\RouteServiceProvider;

class Router
{
    public $controller;
    public $function;
    public $requestMethod;

    public $route;

    public function __construct($requestMethod, $route, public $action = null)
    {
        $this->requestMethod = strtoupper($requestMethod);

        $this->route = trim($route, '/');

        $this->setRouterToServiceProvider();
    }

    public function controller($controller)
    {
        $this->controller = new $controller();

        $this->setRouterToServiceProvider();

        return $this;
    }

    public function function($function)
    {
        $this->function = $function;

        $this->setRouterToServiceProvider();

        return $this;
    }

    private function setRouterToServiceProvider()
    {
        RouteServiceProvider::$routes[$this->requestMethod][$this->route] = $this;
    }
}
