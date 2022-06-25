<?php

namespace App\Controllers;

use App\Models\Category;
use App\Controllers\Controller;

class CategoryController extends Controller
{
    public static function createCategory()
    {
        if (!validator(['title', 'description', 'parent']))
            back();

        if (!Category::createCategory(POST('parent'), POST('title'), POST('description'))) {
            $_SESSION['message'] = [
                'title' => 'عملیات ناموفق',
                'type' => 'error',
                'text' => 'عملیات با خطا مواجه شد!!',
            ];

            back();
        }
        
        $_SESSION['message'] = [
            'title' => 'عملیات موفق',
            'type' => 'success',
            'text' => 'دسته بندی با موفقیت ثبت شد!',
        ];
    }

    public static function updateCategory()
    {
        if (!validator(['title', 'description', 'parent']))
            back();

        if (!Category::updateCategory(POST('id'), POST('parent'), POST('title'), POST('description'))) {
            responseJson([
                'status' => 201,
                'message' => [
                    'title' => 'عملیات ناموفق',
                    'text' => 'عملیات با خطا مواجه شد!',
                    'type' => 'error'
                ]
            ]);
        }

        responseJson([
            'status' => 200,
            'message' => [
                'title' => 'عملیات موفق',
                'text' => 'دسته با موفقیت ویرایش شد!',
                'type' => 'success'
            ]
        ]);
    }
}
