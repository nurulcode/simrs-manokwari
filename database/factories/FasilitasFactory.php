<?php

use Faker\Generator as Faker;
use App\Models\Master\JenisPoliklinik;

$factory->define(App\Models\Fasilitas\Poliklinik::class, function (Faker $faker) {
    return [
        'kode'     => strtoupper(substr($faker->unique()->word, 0, 12)),
        'nama'     => $faker->sentence(2),
        'jenis_id' => function () {
            return factory(JenisPoliklinik::class)->create()->id;
        }
    ];
});
