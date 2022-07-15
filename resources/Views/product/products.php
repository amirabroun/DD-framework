<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

$categories = Category::all();
$brands = Brand::all();
$products = Product::all();

dd($categories, $brands, $products);
