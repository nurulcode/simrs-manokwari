<?php

use Faker\Generator as Faker;
use App\Enums\KategoriRegistrasi;

$factory->define(App\Models\Tarif\TarifRegistrasi::class, function (Faker $faker) {
    return [
        'uraian'          => $faker->sentence,
        'kategori'        => KategoriRegistrasi::getRandomValue(),
        'tarif_sarana'    => $faker->randomDigit,
        'tarif_pelayanan' => $faker->randomDigit,
        'tarif_bhp'       => $faker->randomDigit
    ];
});
