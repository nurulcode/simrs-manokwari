<?php

use App\Models\Logistik;
use App\Enums\GolonganObat;
use Faker\Generator as Faker;
use App\Models\Master\JenisLogistik;
use App\Enums\SistemPembayaran;

$factory->define(Logistik\Logistik::class, function (Faker $faker) {
    return [
        'uraian'   => $faker->sentence,
        'satuan'   => $faker->word,
        'jenis_id' => function () {
            return factory(JenisLogistik::class)->create()->id;
        },
        'golongan' => GolonganObat::getRandomValue()
    ];
});

$factory->define(Logistik\Suplier::class, function (Faker $faker) {
    return [
        'nama'       => $faker->company,
        'alamat'     => $faker->address,
        'no_telepon' => $faker->phoneNumber
    ];
});

$factory->define(Logistik\Penerimaan::class, function (Faker $faker) {
    return [
        'suplier_id' => function () {
            return factory(Logistik\Suplier::class)->create()->id;
        },
        'no_faktur'         => $faker->unique()->swiftBicNumber,
        'sistem_pembayaran' => SistemPembayaran::getRandomValue(),
        'tanggal_faktur'    => $faker->dateTimeThisMonth,
        'jatuh_tempo'       => $faker->dateTimeThisMonth,
        'tanggal_terima'    => $faker->dateTimeThisMonth,
    ];
});
