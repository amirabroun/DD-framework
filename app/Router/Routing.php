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
     * Current route
     * 
     * @var string $route
     */
    private string $route = '';

    /**
     * Current router
     * 
     * @var Router $router
     */
    private Router $router;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    /**
     * Find currnet route for action and set to $this->route
     * 
     * @return $this
     */
    public function findRoute()
    {
        $this->route = $this->searchInContainerRoute();

        return $this;
    }

    /**
     * Find currnet router for $this->route
     * 
     * @return $this
     */
    public function findRouter()
    {
        $this->router = RouteServiceProvider::$routes[requestMethod()][$this->route];

        return $this;
    }

    /**
     * Run Router
     * 
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

    private function searchInContainerRoute()
    {
        if (isset(RouteServiceProvider::$routes[requestMethod()][uri()])) {
            return uri();
        }

        foreach ($this->routes as $key => $route) {
            if (!checkRoute($route)) {
                continue;
            }

            return $this->routes[$key];
        }
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
