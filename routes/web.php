<?php

use App\Models\{Admin, Category, User};
use App\QueryBuilder\Builder;
use App\Router\Route;

// test
Route::get('/test', function () {
    $user = User::find(95)->new(['mobile' => '0000000']);
    $user->first_name = 'amirrr';
    $user->update();

    $user = User::find(87);
    $user->delete();

    $newUserFromConstructor = new User;
    $newUserFromConstructor->first_name = 'yaser';
    $newUserFromConstructor->last_name = 'nasiri';
    $newUserFromConstructor->mobile = '0928381';
    $newUserFromConstructor->save();

    $Jon = Builder::table('users')
        ->select(['id', 'first_name'])
        ->where('id', '<', 12)
        ->andWhere('first_name', '=', 'Jon')
        ->orWhere('last_name', '=', 'kelly')
        ->take(1)->get();

    $newUserWithBuilder = Builder::table('users')->new([
        'first_name' => 'simin',
        'last_name' => 'jalili',
        'mobile' => '09884401',
    ])->save();


    $newUser = User::create([
        'first_name' => 'atena',
        'last_name' => 'aghdasi',
        'mobile' => '0915789099',
    ]);

    $newUser->gender = 'female';
    $newUser->save();

    $category = Category::query()->where('title', '=', 'کالای دیجیتال')->andWhere('id', '=', '3')->get();
    $user = User::find(2);
    $admin = Admin::query()->where('username', '=', 'admin')->first();
    $users = User::all(['id', 'last_name', 'mobile']);
    $adminLogin = Admin::login('admin', 12345678);

    dd(
        $newUserFromConstructor,
        User::all(),
        $Jon,
        $newUser,
        $newUserWithBuilder,
        $adminLogin,
        $users,
        $admin,
        $user,
        $category
    );
});

// index
Route::get('/', function () {
    includePath()->view('index');
});
