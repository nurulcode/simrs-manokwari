<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Master\Penyakit\KlasifikasiPenyakit::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->word,
        'uraian' => $faker->sentence
    ];
});
