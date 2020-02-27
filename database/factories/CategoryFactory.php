<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'position' => $faker->randomNumber(2),
        'image' => $faker->imageUrl(500, 500, 'food')
    ];
});
