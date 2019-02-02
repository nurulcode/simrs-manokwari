<?php

use Faker\Generator as Faker;
use App\Models\Master\JenisLogistik;
use App\Enums\GolonganObat;

$factory->define(App\Models\Logistik\Logistik::class, function (Faker $faker) {
    return [
        'uraian'   => $faker->sentence,
        'satuan'   => $faker->word,
        'jenis_id' => function () {
            return factory(JenisLogistik::class)->create()->id;
        },
        'golongan' => GolonganObat::getRandomValue()
    ];
});
