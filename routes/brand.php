<?php

use App\Router\Route;

/*
|--------------------------------------------------------------------------
| Prefix brands
|--------------------------------------------------------------------------
*/

Route::get('/brands', function () {
    includePath()->view('brand.brands');
});
