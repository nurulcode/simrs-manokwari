<?php

use Faker\Generator as Faker;
use App\Models\Fasilitas\Ruangan;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Master\JenisPoliklinik;

$factory->define(Poliklinik::class, function (Faker $faker) {
    return [
        'kode'     => strtoupper(substr($faker->unique()->word, 0, 12)),
        'nama'     => $faker->sentence(2),
        'jenis_id' => function () {
            return factory(JenisPoliklinik::class)->create()->id;
        }
    ];
});

$factory->define(Ruangan::class, function (Faker $faker) {
    return [
        'poliklinik_id' => function () {
            return factory(Poliklinik::class)->create()->id;
        },
        'kode'  => $faker->unique()->word,
        'nama'  => $faker->word,
        'kelas' => 1,
        'jenis' => 1
    ];
});
