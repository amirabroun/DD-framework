<?php

use App\Models\{Admin, Category, User};
use App\Router\Route;

// test
Route::get('/test', function () {
    $categoreis = Category::query()->where('title', '=', 'admin')->andWhere('id', '=', '3')->get();
    $user = User::find(81);
    $admin = Admin::query()->where('username', '=', 'admin')->first();
    $users = User::all(['id', 'last_name', 'mobile']);
    $adminLogin = Admin::login('admin', 12345678);

    dd($adminLogin, $users, $admin, $user, $categoreis);
});

// index
Route::get('/', function () {
    includePath()->view('index');
});
