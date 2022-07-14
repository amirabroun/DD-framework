<?php

namespace App\Models;

class Admin extends Model
{
    /**
     * Column in database
     *
     * @var array
     */
    protected array $fillable = [
        'first_name', 'last_name', 'mobile',
        'username', 'password',
        'status', 'created_at', 'updated_at'
    ];

    /**
     * Loginig admin
     *
     * @param string $username
     * @param string|int $password
     * @return $this|false
     */
    public static function login($username, $password)
    {
        $admin = static::query()->where('username', '=', $username)->first();

        if (!bcrypt($password, $admin->password ?? null)) {
            return false;
        }

        return $admin;
    }
}
