<?php

namespace App\Router;

use App\Provider\RouteServiceProvider;

class Router
{
    /**
     * @var string $requestMethod GET|POST|PUT|PATCH|DELETE|ANY
     */
    private string $requestMethod = '';

    /**
     * @var string $route 
     */
    private string $route = '';

    /**
     * @var string|null $controller 
     */
    public $controller;

    /**
     * @var string|array|callable $function
     */
    public $function;

    /**
     * Create new Router
     * 
     * @param string $requestMethod
     * @param string $route
     * @param string|array|callable $action
     */
    public function __construct(string $requestMethod, string $route, $action = null)
    {
        $this
            ->route($route)
            ->requestMethod($requestMethod)
            ->setAction($action)
            ->setToRouteContainer();
    }

    /**
     * @param string $controller 
     * 
     * @return $this
     */
    public function controller(string $controller)
    {
        $this->controller = new $controller();

        return $this->setToRouteContainer();
    }

    /**
     * @param string|array|callable $function 
     * 
     * @return $this
     */
    public function function(string|array|callable $function)
    {
        $this->function = $function;

        return $this->setToRouteContainer();
    }

    /**
     * @param string $route 
     * 
     * @return $this
     */
    private function route(string $route)
    {
        $this->route = trim($route, '/');

        return $this;
    }

    /**
     * @param string $requestMethod 
     * 
     * @return $this
     */
    private function requestMethod(string $requestMethod)
    {
        $this->requestMethod = strtoupper($requestMethod);

        return $this;
    }

    /**
     * @param string|array|callable|null $action
     * 
     * @return $this
     */
    private function setAction(string|array|callable|null $action)
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
     * Set new router with this route and request method
     * 
     * @return $this
     */
    private function setToRouteContainer()
    {
        RouteServiceProvider::$routes[$this->route][$this->requestMethod] = $this;

        return $this;
    }
}
