<?php

namespace App\Models;

use App\DataBase\DataBase;
use PDO;

class Product extends Model
{
    protected array $fillable = [
        'title',
        'brand_id', // foreign key
        'tracking_code',
        'slug',
        'price',
        'price_discounted',
        'description',
        'stock',
        'status',
    ];

    public static function createProduct($title, $price, $price_discounted, $stock, $brand_id, $description)
    {
        $title = sanitise($title);
        $brand_id = (!(int)$brand_id) ? null : (int)$brand_id;
        $tracking_code = 'DSP-' . generateDigit(8);
        $slug = sluggable($title);
        $price = sanitise($price);
        $price_discounted = (int)($price_discounted);
        $description = sanitise($description);
        $stock = (!(int)$stock) ? null : (int)$stock;

        $action = new Model("INSERT INTO `products` (`brand_id`, `title`, `slug`, `price`, `price_discounted`, `stock`, `description`, `tracking_code`) VALUES (?,?,?,?,?,?,?,?);");

        $action->bindValue($brand_id, $title, $slug, $price, $price_discounted, $stock, $description, $tracking_code);

        if (!$action->execute()) {
            return false;
        }

        return $action->lastInsertId();
    }

    public static function getProducts()
    {
        $action = new Model("SELECT products.*, brands.title as brand_title 
                    From `products`
                        left join brands 
                            on products.brand_id = brands.id");

        $action->execute();

        if (!$action->rowCount() > 0) {
            return false;
        }

        return $action->fetchAllObject();
    }

    public static function getProduct($id)
    {
        $action = new Model("SELECT products.*, brands.title as brand_title, brands.id as brand_id From products
                                left join brands 
                                    on products.brand_id = brands.id 
                                        where products.id = ? LIMIT 1");

        $action->execute($id);

        if (!($action->rowCount() > 0)) {
            return false;
        }

        return $action->fetchObject();
    }

    public static function getProductWithSlug($slug)
    {
        $action = new Model("SELECT products.*, brands.title as brand_title, brands.id as brand_id From products
                                left join brands 
                                    on products.brand_id = brands.id 
                                        where products.slug = ? LIMIT 1");

        $action->execute($slug);

        if (!($action->rowCount() > 0)) {
            return false;
        }

        return $action->fetchObject();
    }

    public static function getCategories($id)
    {
        $action = new Model("SELECT category_product.*, categories.* From category_product
                                left join categories 
                                    on category_product.category_id = categories.id 
                                        where product_id = ?");

        $action->execute($id);

        if (!($action->rowCount() > 0)) {
            return false;
        }

        return self::sortingCategories($action->fetchAllObject());
    }

    public static function sortingCategories(array|object $categories, $return = 'all|parent|child')
    {
        $category_parent_id = 0;

        foreach ($categories as $category) {
            if (isEmpty($category->parent_id)) {
                $category_parent_id = $category->id;
            }
        }

        $row = count($categories);
        $clean_category_id = [$category_parent_id];

        while ($row) {
            foreach ($categories as $category) {
                if ($category->parent_id == $category_parent_id) {
                    $clean_category_id[] = $category->id;
                    $category_parent_id = $category->id;
                }
            }
            $row--;
        }

        $clean_category = [];
        foreach ($clean_category_id as $category_id) {
            foreach ($categories as $category) {
                if ($category->id === $category_id) {
                    $clean_category[] = $category;
                }
            }
        }

        if ($return === 'parent')
            return $clean_category[0];
        if ($return === 'child')
            return end($clean_category);

        return $clean_category;
    }

    public static function updateProduct($id, $brand_id, $title, $description)
    {
        $title = sanitise($title);
        $description = sanitise($description);
        $brand_id = (!(int)$brand_id) ? null : (int)$brand_id;
        $id = (int)$id;
        $slug = sluggable($title);

        $action = new Model("UPDATE products set title = ?, description = ?, slug = ?, brand_id = ? where id = ?;");

        return $action->execute([$title, $description, $slug, $brand_id, $id]);
    }

    public static function createPhotoProduct($photo_id, $product_id, $sort)
    {
        $photo_id = (int)$photo_id;
        $product_id = (int)$product_id;
        $sort = (int)$sort;

        $action = new Model("INSERT into photo_product (photo_id, product_id, sort) values (?, ?, ?);");

        return $action->execute([$photo_id, $product_id, $sort]);
    }

    public static function deletePhotoProduct($product_id, $sort)
    {
        $product_id = (int)$product_id;
        $sort = (int)$sort;

        $action = new Model("DELETE FROM photo_product where product_id = ? and sort = ?;");

        return $action->execute([$product_id, $sort]);
    }

    public static function createCategoryProduct($category_id, $product_id)
    {
        $category_id = (int)$category_id;
        $product_id = (int)$product_id;

        $action = new Model("INSERT into category_product (category_id, product_id) values (?, ?);");

        return $action->execute([$category_id, $product_id]);
    }
}
