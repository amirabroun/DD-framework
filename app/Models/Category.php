<?php

namespace App\Models;

use PDO;

class Category extends Model
{
    public static function getCategoryParents()
    {
        $action = new Model("SELECT * From categories where parent_id IS NULL and status = 'active'");

        $action->execute();

        if (!$action->rowCount() > 0) {
            return false;
        }

        return $action->fetchAllObject();
    }

    public static function getCategoryParent(int $id)
    {
    }

    public static function getCategoryChilds(int $id)
    {
        $action = new Model("SELECT * From categories where parent_id = ?");

        $action->execute([$id]);

        if (!$action->rowCount() > 0) {
            return false;
        }

        return $action->fetchAllObject();
    }

    public static function createCategory($parent_id, $title, $description)
    {
        $title = sanitise($title);
        $description = sanitise($description);
        $parent_id = (!(int)$parent_id) ? null : (int)$parent_id;
        $slug = sluggable($title);

        $action = new Model("INSERT into categories (parent_id, title, slug, description) values (?,?,?,?);");

        return $action->execute([$parent_id, $title, $slug, $description]);
    }

    public static function getCategories()
    {
        $action = new Model("SELECT * From categories");

        $action->execute();

        if (!$action->rowCount() > 0) {
            return false;
        }

        return $action->fetchAllObject(PDO::FETCH_OBJ);
    }

    public static function updateCategory($id, $parent_id, $title, $description): bool
    {
        $title = sanitise($title);
        $description = sanitise($description);
        $parent_id = (!(int)$parent_id) ? null : (int)$parent_id;
        $id = (int)$id;
        $slug = sluggable($title);

        $action = new Model("UPDATE categories set title = ?, description = ?, slug = ?, parent_id = ? where id = ?;");

        return $action->execute([$title, $description, $slug, $parent_id, $id]);
    }
}
