<?php

namespace App\Provider;

use App\Router\Routing;

class RouteServiceProvider
{
    /**
     * @var array $routes
     */
    public static array $routes = [];

    /**
     * Boot file 
     *
     * @return Routing
     */
    public static function loadRoutes()
    {
        $instance = new static;

        $instance->boot();

        return new Routing();
    }

    /**
     * Require routes
     * 
     * @return $this
     */
    private function boot()
    {
        $this->routes('web.php', 'brand.php', 'category.php', 'product.php', 'auth.php');

        return $this;
    }

    /**
     * Require routes file
     *
     * @param string ...$routes
     * @return $this
     */
    private function routes(...$routes)
    {
        foreach ($routes as $route) {
            require __DIR__ .  "/../../routes/" . $route;
        }

        return $this;
    }
}
