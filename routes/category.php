<?php

use App\Router\Route;

/*
|--------------------------------------------------------------------------
| Prefix /categories
|--------------------------------------------------------------------------
*/

Route::get('/categories', function () {
    includePath()->view('category.categories');
});
