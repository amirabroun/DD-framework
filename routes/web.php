<?php

use App\Models\{Admin, Category, User};
use App\Router\Route;

// test
Route::get('/test', function () {
    $newUser = User::create([
        'first_name' => 'amir',
        'last_name' => 'abroun',
        'mobile' => '09398720306',
    ]);
    $newUser->gender = 'male';
    $newUser->save();

    $categoreis = Category::query()->where('title', '=', 'admin')->andWhere('id', '=', '3')->get();
    $user = User::find(81);
    $admin = Admin::query()->where('username', '=', 'admin')->first();
    $users = User::all(['id', 'last_name', 'mobile']);
    $adminLogin = Admin::login('admin', 12345678);

    dd($newUser, $adminLogin, $users, $admin, $user, $categoreis);
});

// index
Route::get('/', function () {
    includePath()->view('index');
});
