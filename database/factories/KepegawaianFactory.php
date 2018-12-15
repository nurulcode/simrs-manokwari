<?php

use Faker\Generator as Faker;
use App\Models\Kepegawaian;

$factory->define(Kepegawaian\Jabatan::class, function (Faker $faker) {
    return ['uraian' => $faker->sentence];
});

$factory->define(Kepegawaian\KategoriKualifikasi::class, function (Faker $faker) {
    return [
        'kode'         => $faker->unique()->word,
        'tenaga_medis' => $faker->boolean,
        'uraian'       => $faker->sentence,
    ];
});
