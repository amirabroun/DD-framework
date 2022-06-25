<?php

use App\Router\Route;

// test
Route::get('/test/{name}', function ($name) {
    includePath()->view('/test', ['name' => $name]);
});

// index
Route::get('/', function () {
    includePath()->view('index');
});

// auth
Route::get('/login/secret/' . md5(secretKey('secret_login')), function () {
    includePath()->view('auth.login');
});

Route::post('/login/secret/' . md5(secretKey('secret_login')))
    ->controller(App\Controllers\LoginController::class)
    ->function('adminLogin');

Route::post('logOut', 'LoginController@logOut');

// product
Route::get('/products', function () {
    includePath()->view('product.products');
});

Route::get('/products/{id}',  function ($id) {
    includePath()->view('product.single-product', ['id' => $id]);
});

// brand
Route::get('/brands', function () {
    includePath()->view('brand.brands');
});

// category
Route::get('/categories', function () {
    includePath()->view('category.categories');
});

// user
Route::get('/users', function () {
    includePath()->view('user.users');
});
