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
