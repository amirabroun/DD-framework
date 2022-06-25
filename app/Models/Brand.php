<?php

namespace App\Models;


class Brand extends Model
{
    public static function getBrands()
    {
        $action = new Model("SELECT * From brands");

        $action->execute();

        if (!$action->rowCount() > 0) {
            return false;
        }

        return $action->fetchAllObject();
    }

    public static function getBrand(int $id)
    {
        $action = new Model("SELECT * From brands where id = ?");

        $action->execute([$id]);

        if (!$action->rowCount() > 0) {
            return false;
        }

        return $action->fetchObject();
    }

    public static function createBrand($title, $description): bool
    {
        $title = sanitise($title);
        $description = sanitise($description);

        $action = new Model("INSERT INTO brands(title, description) VALUES (?,?)");

        return $action->execute([
            $title, $description
        ]);
    }

    public static function updateBrand(int $id, $title, $description): bool
    {
        $title = sanitise($title);
        $description = sanitise($description);

        $action = new Model("update brands set title=?, description=? where id=$id");

        return $action->execute([$title, $description]);
    }
}
