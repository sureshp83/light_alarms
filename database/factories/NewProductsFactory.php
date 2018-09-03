<?php

use App\Models\ProductCategory;
use App\Models\NewProduct;
use Faker\Generator as Faker;

// Cache data
$prodCategories = ProductCategory::pluck('id');

$factory->define(NewProduct::class, function (Faker $faker) use ($prodCategories){
    $name = $faker->name;

    return [
        "product_category_id" => $prodCategories->random(),
        "name"                => $name,
        "slug"                => str_slug($name),
        "launch_date"         => Carbon\Carbon::now()->addMonth(rand(5,8))->addDay(rand(1,5)),
        "application"         => $faker->realText(650, 2),
        "description"         => $faker->realText(650, 2),
        "created_at"          => Carbon\Carbon::now(),
        "updated_at"          => Carbon\Carbon::now(),
        "deleted_at"          => NULL,
    ];
});
