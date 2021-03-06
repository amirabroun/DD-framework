<?php

namespace App\Router;

/**
 * @method static Router get(string $uri, string|array|callable $action = null) 
 * @method static Router post(string $uri, string|array|callable $action = null) 
 * @method static Router put(string $uri, string|array|callable $action = null) 
 * @method static Router patch(string $uri, string|array|callable $action = null) 
 * @method static Router delete(string $uri, string|array|callable $action = null) 
 * 
 * @return @see Router
 */
class Route
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
