<?php

use App\Models\Master;
use App\Models\Pasien;
use Faker\Generator as Faker;

$factory->define(App\Models\Kunjungan::class, function (Faker $faker) {
    return [
        'pasien_id' => function () {
            return factory(Pasien::class)->create()->id;
        },
        'kasus_id' => function () {
            return factory(Master\Kasus::class)->create()->id;
        },
        'penyakit_id' => function () {
            return factory(Master\Penyakit\Penyakit::class)->create()->id;
        },
        'jenis_rujukan_id' => function () {
            return factory(Master\JenisRujukan::class)->create()->id;
        },
        'cara_pembayaran_id' => function () {
            return factory(Master\CaraPembayaran::class)->create()->id;
        },
        'pasien_baru'     => $faker->randomElement([0, 1]),
        'rujukan_asal'    => $faker->company,
        'rujukan_nomor'   => $faker->word,
        'rujukan_tanggal' => $faker->dateTimeThisMonth,
        'pj_nama'         => $faker->name,
        'pj_telepon'      => $faker->phoneNumber,
        'sjp_nomor'       => $faker->word,
        'sjp_tanggal'     => $faker->dateTimeThisMonth
    ];
});
