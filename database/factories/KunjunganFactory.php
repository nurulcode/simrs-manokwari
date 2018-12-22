<?php

use App\Models\Master;
use App\Models\Tarif;
use App\Models\Pasien;
use Faker\Generator as Faker;
use App\Enums\KategoriRegistrasi;
use App\Models\Fasilitas\Poliklinik;

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
        'keluhan'         => $faker->sentence,
        'rujukan_asal'    => $faker->company,
        'rujukan_nomor'   => $faker->word,
        'rujukan_tanggal' => $faker->date,
        'pj_nama'         => $faker->name,
        'pj_telepon'      => $faker->phoneNumber,
        'sjp_nomor'       => $faker->word,
        'sjp_tanggal'     => $faker->date
    ];
});

$factory->define(App\Models\RawatJalan::class, function (Faker $faker) {
    return [
        'tarif_registrasi_id' => function () {
            return factory(Tarif\TarifRegistrasi::class)->create([
                'kategori' => KategoriRegistrasi::RAWAT_JALAN
            ])->id;
        },
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'poliklinik_id' => function () {
            return factory(Poliklinik::class)->create()->id;
        },
    ];
});
