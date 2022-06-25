<?php

namespace App\Models;


class Admin extends Model
{
    public static function doLogin($username, $password)
    {
        $action = new Model("SELECT * From admins where username = ? LIMIT 1");
        $action->execute($username);

        if (!($action->rowCount() > 0))
            return false;

        $admin = $action->fetchObject();
        if (!bcrypt($password, $admin->password))
            return false;

        return $admin;
    }

    public static function getAdmin($id)
    {
        $action = new Model("SELECT * From admins where id = ? LIMIT 1");

        $action->execute($id);

        if (!($action->rowCount() > 0)) {
            return false;
        }

        return $action->fetchObject();
    }
}
