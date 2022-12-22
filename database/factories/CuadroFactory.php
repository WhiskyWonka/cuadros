<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cuadro;
use Faker\Generator as Faker;

$factory->define(Cuadro::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'painter' => $faker->word,
        'country' => $faker->country,
    ];
});
