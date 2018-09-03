<?php

use App\Models\Agency;
use Faker\Generator as Faker;

// Cache data
$agencies = Agency::pluck('id');

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) use ($agencies) {
    return [
        'role_id'        => rand(2, 3),     // Random "Agency admin" or "Agent"
        'agency_id'      => $agencies->random(),
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => bcrypt(str_random(8)),
        'phone'          => rand(222000000, 999000000),
        'phone_ext'      => rand(333, 666),
        'remember_token' => str_random(10),
    ];
});
