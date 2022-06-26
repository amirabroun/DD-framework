<?php

use App\Provider\RouteServiceProvider;
use App\Router\Route;

/*
|--------------------------------------------------------------------------
| Prefix /products
|--------------------------------------------------------------------------
*/

Route::get('/products', function () {
    includePath()->view('product.products');
});

Route::get('/products/{id}',  function ($id) {
    includePath()->view('product.single-product', ['id' => $id]);
});
