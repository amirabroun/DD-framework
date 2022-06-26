<?php


$categories = App\Models\Category::getCategories();
$brands = App\Models\Brand::getBrands();
$products = App\Models\Product::getProducts();
dd($categories, $brands, $products);