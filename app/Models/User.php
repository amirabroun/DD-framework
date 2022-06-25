<?php

namespace App\Models;

use PDO;

class User extends Model
{
    public static function getUsers()
    {
        $action = new Model("SELECT * From users");

        $action->execute();

        if (!$action->rowCount() > 0) {
            return false;
        }

        return $action->fetchAllObject();
    }
}
