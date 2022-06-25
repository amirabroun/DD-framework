<?php

namespace App\Router;

class Route 
{

    public static function get(string $route, $action = null)
    {
        return new Router(__FUNCTION__, $route, $action);
    }

    public static function post(string $route, $action = null)
    {
        return new Router(__FUNCTION__, $route, $action);
    }

    public static function put(string $route, $action = null)
    {
        return new Router(__FUNCTION__, $route, $action);
    }

    public static function patch(string $route, $action = null)
    {
        return new Router(__FUNCTION__, $route, $action);
    }

    public static function delete(string $route, $action = null)
    {
        return new Router(__FUNCTION__, $route, $action);
    }

    public static function any(string $route, $action = null)
    {
        return new Router(__FUNCTION__, $route, $action);
    }
}
