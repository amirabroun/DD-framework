<?php

use App\Router\Route;

/*
|--------------------------------------------------------------------------
| Prefix login, log-out
|--------------------------------------------------------------------------
*/

Route::get('login/secret/' . md5(secretKey('secret_login')), function () {
    includePath()->view('auth.login');
});

Route::post('/login/secret/' . md5(secretKey('secret_login')))
    ->controller(App\Controllers\LoginController::class)
    ->function('adminLogin');

Route::post('log-out', 'LoginController@logOut');
