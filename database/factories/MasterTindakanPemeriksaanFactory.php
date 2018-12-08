<?php

use Faker\Generator as Faker;
use App\Enums\JenisTindakanPemeriksaan;
use App\Models\Master\TindakanPemeriksaan;

$factory->define(TindakanPemeriksaan::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->word,
        'uraian' => $faker->sentence,
        'jenis'  => $faker->randomElement(JenisTindakanPemeriksaan::getValues())
    ];
});
