<?php

namespace App\Models;


class Admin extends Model
{

    protected array $fillable = [
        'first_name', 'last_name', 'mobile',
        'username', 'password',
        'status', 'created_at', 'updated_at'
    ];

    public static function login($username, $password)
    {
        $admin = parent::query()->where('username', '=', $username)->first();

        if (!bcrypt($password, $admin->password ?? null)) {
            return false;
        }

        return $admin;
    }
}
