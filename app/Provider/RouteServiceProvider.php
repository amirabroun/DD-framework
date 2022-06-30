<?php

namespace App\Provider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * @var array $routes
     */
    public static $routes = [];

    private function boot()
    {
        return $this->routes('auth.php', 'brand.php', 'category.php', 'product.php', 'web.php');
    }

    /**
     * Current file for this prefix
     * 
     * @param string $prefix
     * @return string CurrentFile
     */
    public static function loadRoutes()
    {
        $instance = new static;

        $instance->boot();
    }
}
