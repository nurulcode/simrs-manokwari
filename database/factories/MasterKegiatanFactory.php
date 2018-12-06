<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Master\KategoriKegiatan::class, function (Faker $faker) {
    return [
        'uraian' => $faker->sentence
    ];
});

$factory->define(App\Models\Master\Kegiatan::class, function (Faker $faker) {
    return [
        'uraian' => $faker->sentence
    ];
});
