<?php

use App\Enums;
use App\Models\Master;
use App\Models\Fasilitas;
use App\Models\Perawatan;
use Faker\Generator as Faker;

$factory->define(Perawatan\RawatJalan::class, function (Faker $faker) {
    return [
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'poliklinik_id' => function () {
            return factory(Fasilitas\Poliklinik::class)->create()->id;
        },
    ];
});

$factory->define(Perawatan\RawatDarurat::class, function (Faker $faker) {
    return [
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'poliklinik_id' => function () {
            return factory(Fasilitas\Poliklinik::class)->create()->id;
        },
    ];
});

$factory->define(Perawatan\RawatInap::class, function (Faker $faker) {
    return [
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'cara_penerimaan' => Enums\CaraPenerimaan::getRandomValue(),
        'aktifitas'       => Enums\Aktifitas::getRandomValue()
    ];
});
