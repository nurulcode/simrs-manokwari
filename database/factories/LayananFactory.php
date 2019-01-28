<?php

use App\Models\Master;
use App\Models\Perawatan;
use App\Models\Layanan;
use App\Enums\KasusDiagnosa;
use Faker\Generator as Faker;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Master\PemeriksaanUmum;
use App\Models\Fasilitas\Ranjang;
use App\Models\Master\JenisVisite;
use App\Models\Master\PerawatanKhusus;

$perawatans = [
    Perawatan\RawatJalan::class,
    Perawatan\RawatInap::class,
    Perawatan\RawatDarurat::class,
];

$factory->define(Layanan\Diagnosa::class, function (Faker $faker) use ($perawatans) {
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

$factory->define(Layanan\Tindakan::class, function (Faker $faker) use ($perawatans) {
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
        'jumlah' => $faker->randomNumber,
        'waktu'  => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Layanan\Pemeriksaan::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'pemeriksaan_umum_id' => function ($pemeriksaan) {
            return factory(PemeriksaanUmum::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'hasil' => $faker->randomNumber,
        'waktu' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(App\Models\Layanan\Kamar::class, function (Faker $faker) {
    return [
        'perawatan_type' => Perawatan\RawatInap::class,
        'perawatan_id'   => function () {
            return factory(Perawatan\RawatInap::class)->create()->id;
        },
        'ranjang_id'     => function () {
            return factory(Ranjang::class)->create()->id;
        },
        'waktu_masuk'    => $faker->dateTimeThisMonth,
        'tarif'          => '{}'
    ];
});

$factory->define(App\Models\Layanan\Visite::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'jenis_visite_id' => function ($pemeriksaan) {
            return factory(JenisVisite::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'           => $faker->dateTimeThisMonth,
    ];
});

$factory->define(App\Models\Layanan\Keperawatan::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'perawatan_khusus_id' => function ($pemeriksaan) {
            return factory(PerawatanKhusus::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'  => $faker->dateTimeThisMonth,
        'jumlah' => $faker->randomNumber,
    ];
});
