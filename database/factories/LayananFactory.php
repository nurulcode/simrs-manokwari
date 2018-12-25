<?php

use App\Models\Master;
use App\Models\Perawatan;
use App\Enums\KasusDiagnosa;
use Faker\Generator as Faker;
use App\Models\Kepegawaian\Pegawai;

$factory->define(App\Models\Layanan\Diagnosa::class, function (Faker $faker) {
    $perawatans = [Perawatan\RawatJalan::class];

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
    ];
});
