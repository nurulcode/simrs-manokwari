<?php

use App\Models\Master;
use App\Models\Perawatan;
use App\Enums\KasusDiagnosa;
use Faker\Generator as Faker;
use App\Models\Kepegawaian\Pegawai;

$perawatans = [
    Perawatan\RawatJalan::class,
    Perawatan\RawatInap::class,
    Perawatan\RawatDarurat::class,
];

$factory->define(
    App\Models\Layanan\Diagnosa::class, function (Faker $faker) use ($perawatans) {
        return [
            'perawatan_type' => $faker->randomElement($perawatans),
            'perawatan_id'   => function ($diagnosa) {
                return factory($diagnosa['perawatan_type'])->create()->id;
            },
            'penyakit_id' => function () {
                return factory(Master\Penyakit\Penyakit::class)->create()->id;
            },
            'tipe_diagnosa_id' => function () {
                return factory(Master\TipeDiagnosa::class)->create()->id;
            },
            'petugas_id' => function () {
                return factory(Pegawai::class)->create()->id;
            },
            'lama_menderita' => $faker->word,
            'kasus'          => KasusDiagnosa::getRandomValue(),
            'waktu'           => $faker->dateTimeThisMonth,
        ];
    });

$factory->define(
    App\Models\Layanan\Tindakan::class, function (Faker $faker) use ($perawatans) {
        return [
            'perawatan_type' => $faker->randomElement($perawatans),
            'perawatan_id'   => function ($tindakan) {
                return factory($tindakan['perawatan_type'])->create()->id;
            },
            'tindakan_pemeriksaan_id' => function ($tindakan) {
                return factory(Master\TindakanPemeriksaan::class)->create()->id;
            },
            'petugas_id' => function () {
                return factory(Pegawai::class)->create()->id;
            },
            'jumlah'          => $faker->randomNumber,
            'waktu'           => $faker->dateTimeThisMonth,
        ];
    });
