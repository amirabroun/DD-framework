<?php

namespace App\Router;

use App\Provider\RouteServiceProvider;

class Router
{

    /**
     * @var string $requestMethod GET|POST|PUT|PATCH|DELETE|ANY
     */
    public string $requestMethod;

    /**
     * @var string $route 
     */
    public string $route;

    /**
     * @var string|null $controller 
     */
    public $controller;

    /**
     * @var string|array|callable $function Method controller | Callable function
     */
    public $function;

    public function __construct($requestMethod, $route, $action = null)
    {
        $this
            ->route($route)
            ->requestMethod($requestMethod)
            ->setAction($action)
            ->setRouterToServiceProvider();

        // dd($this);
    }

    /**
     * @param string $controller 
     * 
     * @return this
     */
    public function controller($controller)
    {
        $this->controller = new $controller();

        return $this->setRouterToServiceProvider();
    }

    /**
     * @param string $function 
     * 
     * @return this
     */
    public function function($function)
    {
        $this->function = $function;

        return $this->setRouterToServiceProvider();
    }

    /**
     * @param string $route 
     * 
     * @return this
     */
    public function route(string $route)
    {
        $this->route = trim($route, '/');

        return $this;
    }

    /**
     * @param string $requestMethod 
     * 
     * @return this
     */
    public function requestMethod(string $requestMethod)
    {
        $this->requestMethod = strtoupper($requestMethod);

        return $this;
    }

    /**
     * @param string|array|callable|null $action
     * 
     * @return this
     */
    public function setAction(string|array|callable|null $action)
    {
        if (!isset($action)) {
            return $this;
        }

        if (is_callable($action)) {
            return $this->function($action);
        }

        if (is_string($action)) {
            $controller = "App\\Controllers\\" . substr($action, 0, strpos($action, "@"));
            $function = substr($action, strpos($action, "@") + 1);
        } else {
            $controller = $action[0];
            $function = $action[1];
        }

        return $this->controller($controller)->function($function);
    }

    /**
     * @return this
     */
    private function setRouterToServiceProvider()
    {
        RouteServiceProvider::$routes[$this->requestMethod][$this->route] = $this;

        return $this;
    }
}
