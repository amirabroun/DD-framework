<?php

namespace App\Controllers;

use App\Models\Photo;
use App\Models\Product;
use App\Controllers\Controller;

class ProductController extends Controller
{
    public static function uploadPictureProduct()
    {
        if (array_sum($_FILES['picture_product_file']['size']) === 0) {
            responseJson([
                'status' => 205,
                'message' => [
                    'title' => 'عملیات ناموفق',
                    'text' => 'حداقل یک فایل برای آپلود انتخاب کنید!',
                    'type' => 'error',
                ],
            ]);
        }

        $files = [];
        $keys = array_keys($_FILES['picture_product_file']);
        $errors = [];

        foreach ($keys as $item) {
            foreach ($_FILES['picture_product_file'][$item] as $key => $file) {
                if (isset($files[$key])) {
                    $files[$key] = array_merge([$item => $file], $files[$key]);

                    continue;
                }

                $files[$key] = [$item => $file];
            }
        }


        foreach ($files as $key => $file) {
            if (empty($file['size'])) {
                continue;
            }

            $original_name = $file['name'];
            $suffix = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_name = md5($original_name . microtime()) . '.' . $suffix;
            $path = '/images/products/';
            $full_path = rtrim(domain('public'), '/') . $path . $new_name;

            if (@move_uploaded_file($file['tmp_name'], $full_path)) {
                $createPhoto = Photo::createPhoto($new_name, $path);

                if ($createPhoto) {
                    Product::deletePhotoProduct($_POST['product_id'], $key + 1);

                    $createPhotoProduct = Product::createPhotoProduct($createPhoto, $_POST['product_id'], $key + 1);

                    if ($createPhotoProduct) {
                        continue;
                    }
                }
            }

            $errors[] = ['file_name' => $original_name];
        }

        responseJson([
            'status' => (!empty($errors) ? 201 : 200),
            'errors' => $errors,
            'message' => [
                'title' => (!empty($errors) ? 'عملیات ناموفق' : 'عملیات موفق'),
                'text' => (!empty($errors) ? 'عملیات با خطا مواجه شد!' : 'تصاویر با موفقیت آپلود شد!'),
                'type' => (!empty($errors) ? 'error' : 'success'),
            ],
        ]);
    }
}
