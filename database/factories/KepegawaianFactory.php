<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Kepegawaian\KategoriKualifikasi::class, function (Faker $faker) {
    return ['uraian' => $faker->sentence];
});

$factory->define(App\Models\Kepegawaian\Jabatan::class, function (Faker $faker) {
    return ['uraian' => $faker->sentence];
});
