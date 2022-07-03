<?php

use App\Router\Route;

// test
Route::get('/test/{name}/{id}', function ($name, $id) {
    includePath()->view('test', ['name' => $name, 'id' => $id]);
});

// index
Route::get('/', function () {
    includePath()->view('index');
});
