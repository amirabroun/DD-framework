<?php

namespace App\Router;

use App\Helpers\ReflectionHelper;
use App\Provider\RouteServiceProvider;
use Exception;

class Routing
{

    /**
     * @var array $routes
     */
    private array $routes = [];

    /**
     * current route
     * 
     * @var string $route
     */
    private string $route = '';

    /**
     * current router
     * 
     * @var Router $route
     */
    private Router $router;

    /**
     * @var string $prefix
     */
    private string $prefix = '';

    /**
     * @return void
     */
    public function __construct($prefix = null)
    {
        $this->prefix = $prefix ?? explode('/', trim(uri(), '/'))[0];
    }

    public function findRoute()
    {
        if (isset(RouteServiceProvider::$routes[requestMethod()][uri()])) {
            $this->route = uri();

            return $this;
        }

        $this->routes = array_keys(RouteServiceProvider::$routes[requestMethod()]);

        foreach ($this->routes as $key => $route) {
            if (!checkRoute($route)) {
                continue;
            }

            $this->route = $this->routes[$key];
        }

        return $this;
    }

    public function findRouter()
    {
        $this->router = RouteServiceProvider::$routes[requestMethod()][$this->route];

        return $this;
    }

    /**
     * @return void
     */
    public function run()
    {
        if (!isset($this->router->controller)) {
            $this->runCallable($this->router->function);
        }

        if (isset($this->router->controller, $this->router->function)) {
            $this->runMethodController($this->router->function, $this->router->controller);
        }

        throw new Exception('Oops! Action is null');
    }

    private function runCallable($function)
    {
        if ($paramFunction = $this->getUriDataForCreateParamFunction($function)) {
            call_user_func_array($function, $paramFunction);
            exit;
        }

        call_user_func($function);
        exit;
    }

    private function runMethodController($function, $controller = null)
    {
        if ($paramFunction = $this->getUriDataForCreateParamFunction($function, $controller)) {
            call_user_func_array([new $controller, $function], $paramFunction);
            exit;
        }

        call_user_func([new $controller, $function]);
        exit;
    }

    public static function prefix($prefix = null)
    {
        return new Routing($prefix);
    }

    private function getUriDataForCreateParamFunction($function, $controller = null)
    {
        $paramFunctionTypes = ReflectionHelper::findParamFunctionTypes($function, $controller);

        if (!$paramFunctionTypes) {
            return null;
        }

        if (str_contains($paramFunctionTypes[0], 'App\\Requests\\')) {
            $request = $paramFunctionTypes[0];
            $paramFunction[] = new $request;
            array_shift($paramFunctionTypes);
        }

        $route = explode('/', $this->route);
        $uri = explode('/', uri());

        $paramRoute = [];
        foreach ($route as $key => $partRoute) {
            if (isParamRouteSection($partRoute)) {
                $paramRoute[] = $uri[$key];
            }
        }

        foreach ($paramRoute as $key => $partRoute) {
            if (!isEmpty($paramFunctionTypes[$key])) {
                $type = $paramFunctionTypes[$key];
                settype($partRoute, $type);
            }

            $paramFunction[] = $partRoute;
        }

        return $paramFunction;
    }
}
