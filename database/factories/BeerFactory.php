<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use \App\Models\Beer;
use Faker\Generator as Faker;

$factory->define(Beer::class, function (Faker $faker) {
    return [
        'uid' => $faker->unique()->numberBetween(0, 99999),
        'name' => $faker->unique()->name,
        'abv' => $faker->randomFloat(1, 1, 90),
        'description' => $faker->text,
        'image_url' => $faker->imageUrl($width = 640, $height = 480),
        'tagline' => $faker->company,
    ];
});
