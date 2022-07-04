<?php

namespace App\Router;

use Exception;
use DomainException;
use App\Helpers\ReflectionHelper;

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

    /**
     * @var array $uriData
     */
    private array $uriData = [];

    /**
     * Routing constructor, Get container routes
     * 
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes[requestMethod()];
    }

    /**
     * Find currnet route for action and set to $this->route
     * 
     * @return $this
     */
    public function findRoute()
    {
        $this->route = $this->setUriData()->searchInRouteContainer();

        return $this;
    }

    /**
     * Find currnet router for $this->route
     * 
     * @return $this
     */
    public function findRouter()
    {
        $this->router = $this->routes[$this->route];

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

        throw new Exception('Oops! Action Is Null');
    }

    /**
     * Run closure
     * 
     * @param $function
     * @return never
     */
    private function runCallable($function)
    {
        if ($paramFunction = $this->getParamFunction($function)) {
            call_user_func_array($function, $paramFunction);
            exit;
        }

        call_user_func($function);
        exit;
    }

    /**
     * Run method controller
     * 
     * @param $method
     * @param $controller
     * @return never
     */
    private function runMethodController($method, $controller)
    {
        if ($paramFunction = $this->getParamFunction($method, $controller)) {
            call_user_func_array([new $controller, $method], $paramFunction);
            exit;
        }

        call_user_func([new $controller, $method]);
        exit;
    }

    /**
     * Search in route container and get route if does exist
     * 
     * @return string $route
     * @return DomainException
     */
    private function searchInRouteContainer()
    {
        if (isset($this->routes[uri()])) {
            return uri();
        }

        foreach ($this->routes as $key => $route) {
            if (!checkRoute($route->route)) {
                continue;
            }

            return $key;
        }

        throw new DomainException("-- : Route '" . uri() . "' Does Not Exist : --");
    }

    /**
     * Set all uri data to parameter function 
     * 
     * @param $function
     * @param $controller
     * @return array $parameterFunction
     */
    private function getParamFunction($function, $controller = null)
    {
        return ReflectionHelper::findParamFunctionTypes($function, $controller)
            ->setRequestIfExist()
            ->setParamFunction($this->uriData)
            ->getParamFunction();
    }

    /**
     * Get uri data and set $this->uriData
     * 
     * @return $this
     */
    private function setUriData()
    {
        $route = explode('/', $this->route);
        $uri = explode('/', uri());

        foreach ($route as $key => $partRoute) {
            if (isParamRouteSection($partRoute)) {
                $this->uriData[] = $uri[$key];
            }
        }

        return $this;
    }
}
