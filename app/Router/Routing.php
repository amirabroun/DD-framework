<?php

namespace App\Router;

use App\Helpers\ReflectionHelper;
use App\Provider\RouteServiceProvider;

class Routing
{

    protected string $route;
    protected Router $router;

    public function findRoute()
    {
        if (isset(RouteServiceProvider::$routes[requestMethod()][uri()])) {
            $this->route = uri();

            return $this;
        }

        $routes = array_keys(RouteServiceProvider::$routes[requestMethod()]);

        foreach ($routes as $key => $route) {
            if (!checkRoute($route)) {
                continue;
            }

            $this->route = $routes[$key];
        }

        return $this;
    }

    public function findRouter()
    {
        $this->router = RouteServiceProvider::$routes[requestMethod()][$this->route];

        return $this;
    }

    public function run()
    {
        if (is_string($this->router->action) || is_array($this->router->action)) {
            $this->findAction($this->router->action);
        }

        if (is_callable($this->router->action)) {
            if ($paramFunction = $this->getUriDataForCreateParamFunction($this->router->action)) {
                call_user_func_array($this->router->action, $paramFunction);
                exit;
            }

            call_user_func($this->router->action);
            exit;
        }

        if ($paramFunction = $this->getUriDataForCreateParamFunction($this->router->function, $this->router->controller)) {
            call_user_func_array([new $this->router->controller, $this->router->function], $paramFunction);
        }

        call_user_func([new $this->router->controller, $this->router->function]);
    }

    public function findAction(string|array $action)
    {
        if (is_string($action)) {
            $this->router->controller = "App\\Controllers\\" . substr($action, 0, strpos($action, "@"));
            $this->router->function = substr($action, strpos($action, "@") + 1);
        } else {
            $this->router->controller = $action[0];
            $this->router->function = $action[1];
        }

        return $this;
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
