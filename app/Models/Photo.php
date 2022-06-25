<?php

namespace App\Models;

class Photo extends Model
{
    public static function createPhoto($name, $src)
    {
        $name = sanitise($name);
        $src = sanitise($src);

        $action = new Model("INSERT into photos (src, name) values (?,?);");

        $action->bindValue([$src, $name]);

        if (!$action->execute()) {
            return false;
        }

        return $action->lastInsertId();
    }
}
