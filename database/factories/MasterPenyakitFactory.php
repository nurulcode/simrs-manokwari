<?php

use Faker\Generator as Faker;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

$factory->define(KlasifikasiPenyakit::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->word,
        'uraian' => $faker->sentence
    ];
});

$factory->define(KelompokPenyakit::class, function (Faker $faker) {
    return [
        'klasifikasi_id' => function () {
            return factory(KlasifikasiPenyakit::class)->create()->id;
        },
        'kode'   => strtoupper(substr($faker->unique()->word, 0, 12)),
        'icd'    => strtoupper(substr($faker->unique()->word, 0, 12)),
        'uraian' => $faker->sentence('4')
    ];
});
