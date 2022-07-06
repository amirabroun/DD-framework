<?php

use App\Router\Route;

// test
Route::get('/test/{name}/{id}', function ($name, $id) {
    dd(App\Models\Admin::query()->where('name', '=', 'amir')->get(['name', 'title', 'id', 'uuid']));
});

// index
Route::get('/', function () {
    includePath()->view('index');
});
