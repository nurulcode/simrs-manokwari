<?php

use Faker\Generator as Faker;

$generic_factory = function (Faker $faker) {
    return [
        'uraian' => $faker->sentence
    ];
};

$factory->define(App\Models\Master\Agama::class, $generic_factory);

$factory->define(App\Models\Master\JenisPoliklinik::class, $generic_factory);

$factory->define(App\Models\Master\JenisIdentitas::class, $generic_factory);

$factory->define(App\Models\Master\Pekerjaan::class, $generic_factory);

$factory->define(App\Models\Master\Pendidikan::class, $generic_factory);

$factory->define(App\Models\Master\Suku::class, $generic_factory);

$factory->define(App\Models\Master\Kasus::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->word,
        'uraian' => $faker->sentence
    ];
});
