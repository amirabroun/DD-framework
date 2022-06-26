<?php 

$product = \App\Models\Product::getProduct($id);
$brands = App\Models\Brand::getBrands();
$categories = \App\Models\Product::getCategories($product->id);
$categories = \App\Models\Category::getCategoryParents();
$categories = \App\Models\Category::getCategoryChilds($last_parent_id);
