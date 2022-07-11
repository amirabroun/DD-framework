<?php

namespace App\Router;

/**
 * @method static Router get(string $route, $action = null) 
 * @method static Router post(string $route, $action = null) 
 * @method static Router put(string $route, $action = null) 
 * @method static Router patch(string $route, $action = null) 
 * @method static Router delete(string $route, $action = null) 
 * 
 * @see Router
 */
class Route extends Router
{

    /**
     * New router
     * 
     * @return Router 
     */
    public static function __callStatic(string $method, $action = null)
    {
        return new Router($method, ...$action);
    }
}
