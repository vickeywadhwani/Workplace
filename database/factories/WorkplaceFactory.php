<?php

use Faker\Generator as Faker;

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

$factory->define(App\Workplace::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'price' => $faker->numberBetween($min = 1000, $max = 9000),
        'user_id' => 1,
        'address' => $faker->address, // secret
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'image' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
