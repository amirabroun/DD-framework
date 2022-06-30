<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__ . "/../vendor/autoload.php";

/*
|--------------------------------------------------------------------------
| Auth Section
|--------------------------------------------------------------------------
*/

/**
 * Start Session
 */
if (empty($_SESSION)) {
    session_start();
}

if (isset($_SESSION["_admin_log_"]) && uri() === ('login/secret/' . md5(secretKey('secret_login')))) {
    redirect()->route('/');
}

/*
|--------------------------------------------------------------------------
| Require Routes
|--------------------------------------------------------------------------
*/

\App\Provider\RouteServiceProvider::loadRoutes();

\App\Router\Routing::findRoute()->findRouter()->run();
