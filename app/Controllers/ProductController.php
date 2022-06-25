<?php

namespace App\Controllers;

use App\Config\Config;
use App\Models\Photo;
use App\Models\Product;
use App\Controllers\Controller;
use App\Requests\ProductRequest;

class ProductController extends Controller
{
    public static function createProduct(ProductRequest $request)
    {
        $product = $request->validate();

        $createProduct = Product::createProduct(
            $product->title,
            convertNumberToEnglish($product->price),
            convertNumberToEnglish($product->price_discounted),
            $product->stock,
            $product->brand,
            $product->description
        );

        if (!$createProduct)
            self::failAction();

        foreach ($product->category as $item)
            Product::createCategoryProduct($item, $createProduct);


        self::successCreateAction();
    }

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

    public static function updateProduct(ProductRequest $request)
    {
        $product = $request->validate([
            'title' => 'required',
            'brand_id' => '',
            'description' => 'required',
        ]);

        $updateProduct = Product::updateProduct(
            $product->id,
            $product->brand_id,
            $product->title,
            $product->description
        );

        if (!$updateProduct)
            self::failAction();

        self::successUpdateAction();
    }

    public static function failAction()
    {
        sweetAlert(
            'عملیات با خطا مواجه شد!',
            'عملیات ناموفق',
            'error'
        );
    }

    public static function successUpdateAction()
    {
        sweetAlert(
            'محصول با موفقیت ویرایش شد!',
            'عملیات موفق',
            'success',
            true
        );
    }

    public static function successCreateAction()
    {
        sweetAlert(
            'محصول با موفقیت ایجاد شد!',
            'عملیات موفق',
            'success',
            true
        );
    }
}
