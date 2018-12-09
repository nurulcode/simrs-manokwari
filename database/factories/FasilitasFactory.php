<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Fasilitas\Poliklinik::class, function (Faker $faker) {
    return [
        'kode'  => strtoupper(substr($faker->unique()->word, 0, 12)),
        'nama'  => $faker->sentence(2),
        'jenis' => 1
    ];
});
