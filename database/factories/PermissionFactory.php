<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Permission::class, function (Faker $faker) {
    return [
        'name'        => $faker->unique()->swiftBicNumber,
        'description' => $faker->sentence
    ];
});
