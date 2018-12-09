<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Master\JenisPoliklinik::class, function (Faker $faker) {
    return [
        'uraian' => $faker->sentence
    ];
});
