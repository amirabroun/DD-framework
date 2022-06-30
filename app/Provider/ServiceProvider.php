<?php

namespace App\Provider;

abstract class ServiceProvider
{

    /**
     * Require routes
     * 
     * @return void
     */
    protected function routes(...$routes)
    {
        foreach ($routes as $route) {
            require __DIR__ .  "/../../routes/" . $route;
        }

        return $this;
    }
}
