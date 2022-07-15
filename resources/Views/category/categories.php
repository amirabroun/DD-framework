<?php

use App\Models\Category;

$category_parents = Category::query()->where('parent_id', '=', null)->get();
$categories = Category::all();

dd($categories, $category_parents);
