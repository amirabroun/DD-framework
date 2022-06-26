<?php 
$category_parents = App\Models\Category::getCategoryParents();
$categories = App\Models\Category::getCategories();

dd($categories);