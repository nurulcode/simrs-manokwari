<?php

use App\Models\Kepegawaian;
use Faker\Generator as Faker;

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

$factory->define(Kepegawaian\Kualifikasi::class, function (Faker $faker) {
    return [
        'kategori_id' => function () {
            return factory(Kepegawaian\KategoriKualifikasi::class)->create()->id;
        },
        'kode'        => $faker->unique()->word,
        'uraian'      => $faker->sentence,
        'laki_laki'   => $faker->randomDigit,
        'perempuan'   => $faker->randomDigit
    ];
});
