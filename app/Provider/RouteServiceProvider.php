<?php

namespace App\Provider;

use App\Router\Routing;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * @var array $routes
     */
    public static $routes = [];

    /**
     * Require file
     * 
     * @return $this
     */
    private function boot()
    {
        return $this->routes('web.php', 'brand.php', 'category.php', 'product.php', 'auth.php');
    }

    /**
     * Boot file for require routes and Pass to Routing
     * 
     * @param string $prefix
     * @return Routing 
     */
    public static function loadRoutes()
    {
        $instance = new static;

        return new Routing($instance->boot()::$routes);
    }
}
