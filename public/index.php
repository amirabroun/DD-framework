<?php

use App\Router\Routing;

/**
 * Start Session
 * 
 * @var array $_SESSION
 */
if (empty($_SESSION)) {
    session_start();
}

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

if (empty($_SESSION["_admin_log_"]) && !(in_array(uri(), ignoreAuthPage()))) {
    fail();
}

if (isset($_SESSION["_admin_log_"]) && uri() === ('login/secret/' . md5(secretKey('secret_login')))) {
    redirect()->route('/');
}

/*
|--------------------------------------------------------------------------
| Require Routes
|--------------------------------------------------------------------------
*/

if ((uri() != "/") and preg_match('{/$}', uri())) {
    redirect()->route(preg_replace('{/$}', '', uri()));
}

require __DIR__ .  "/../routes/route.php";

(new Routing)->findRoute()->findRouter()->run();
