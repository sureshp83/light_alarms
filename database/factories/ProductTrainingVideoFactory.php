<?php

use App\Models\ProductCategory;
use App\Models\ProductTrainingVideo;
use Faker\Generator as Faker;

$factory->define(ProductTrainingVideo::class, function (Faker $faker) {
    return [
        "title"       => $faker->catchPhrase,
        "image"       => "https://vimeo.com/50739007",
        "description" => $faker->realText(650, 2),
    ];
});
