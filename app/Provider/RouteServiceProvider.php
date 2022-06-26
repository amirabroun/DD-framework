<?php

namespace App\Provider;


class RouteServiceProvider
{

    /**
     * @var array $routes
     */
    public static $routes = [];

    /**
     * @param key 'prefix'=>'file'
     * 
     * @var array route files
     */
    const FILES = [
        'login' => 'auth.php',
        'log-out' => 'auth.php',
        'brands' => 'brand.php',
        'categories' => 'category.php',
        'products' => 'product.php',
        '' => 'web.php',
    ];

    /**
     * Current file for this prefix
     * 
     * @param string $prefix
     * @return string CurrentFile
     */
    public static function CurrentFile($prefix = null)
    {
        if (!isset($prefix)) {
            $prefix = explode('/', trim(uri(), '/'))[0];
        }

        return self::FILES[$prefix] ?? 'web.php';
    }
}
