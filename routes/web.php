<?php

use App\Router\Route;

// test
Route::get('/test', function () {
    $categoreis = App\Models\Category::query()->where('title', '=', 'admin')->andWhere('id', '=', '3')->get();
    $user = App\Models\User::find(81);
    $admin = App\Models\Admin::query()->where('username', '=', 'admin')->first();
    $users = App\Models\User::all(['id', 'last_name', 'mobile']);

    dd($users, $admin, $user, $categoreis);
});

// index
Route::get('/', function () {
    includePath()->view('index');
});
