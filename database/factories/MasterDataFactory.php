<?php
use App\Models\Master;
use Faker\Generator as Faker;
use App\Enums\KategoriRegistrasi;

$generic_factory = function (Faker $faker) {
    return [
        'uraian' => $faker->sentence
    ];
};

$factory->define(Master\Agama::class, $generic_factory);

$factory->define(Master\JenisPoliklinik::class, $generic_factory);

$factory->define(Master\JenisIdentitas::class, $generic_factory);

$factory->define(App\Models\Master\JenisRujukan::class, $generic_factory);

$factory->define(Master\Pekerjaan::class, $generic_factory);

$factory->define(Master\Pendidikan::class, $generic_factory);

$factory->define(Master\Suku::class, $generic_factory);

$factory->define(Master\Kasus::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->word,
        'uraian' => $faker->sentence
    ];
});

$factory->define(Master\JenisRegistrasi::class, function (Faker $faker) {
    return [
        'uraian'   => $faker->sentence,
        'kategori' => KategoriRegistrasi::getRandomValue()
    ];
});
