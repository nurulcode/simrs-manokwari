<?php

use App\Enums;
use App\Models\Master;
use App\Models\Fasilitas;
use App\Models\Kunjungan;
use App\Models\Perawatan;
use Faker\Generator as Faker;

$factory->define(Perawatan\RawatJalan::class, function (Faker $faker) {
    return [
        'kunjungan_id' => function () {
            return factory(Kunjungan::class)->create()->id;
        },
        'jenis_registrasi_id' => function () {
            return factory(Master\JenisRegistrasi::class)->create([
                'kategori' => Enums\KategoriRegistrasi::RAWAT_JALAN
            ])->id;
        },
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
        'kunjungan_id' => function () {
            return factory(Kunjungan::class)->create()->id;
        },
        'jenis_registrasi_id' => function () {
            return factory(Master\JenisRegistrasi::class)->create([
                'kategori' => Enums\KategoriRegistrasi::GAWAT_DARURAT
            ])->id;
        },
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
        'kunjungan_id' => function () {
            return factory(Kunjungan::class)->create()->id;
        },
        'jenis_registrasi_id' => function () {
            return factory(Master\JenisRegistrasi::class)->create([
                'kategori' => Enums\KategoriRegistrasi::RAWAT_INAP
            ])->id;
        },
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'ranjang_id' => function () {
            return factory(Fasilitas\Ranjang::class)->create()->id;
        },
        'cara_penerimaan' => Enums\CaraPenerimaan::getRandomValue(),
        'aktifitas'       => Enums\Aktifitas::getRandomValue()
    ];
});
