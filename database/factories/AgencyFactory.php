<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Agency::class, function (Faker $faker){
    return [
        "name"           => $faker->company,
        "phone"          => $faker->phoneNumber,
        "address"        => $faker->address,
        "city"           => $faker->city,
        "state_province" => $faker->state,
        "postal_code"    => $faker->postcode,
    ];
});
