<?php

use Faker\Generator as Faker;

$generic_factory = function (Faker $faker) {
    return [
        'uraian' => $faker->sentence
    ];
};

$factory->define(App\Models\Master\JenisPoliklinik::class, $generic_factory);

$factory->define(App\Models\Master\JenisIdentitas::class, $generic_factory);
