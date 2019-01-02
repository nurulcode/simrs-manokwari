<?php

use App\Models\Master;
use App\Models\Kunjungan;
use App\Models\Perawatan;
use Faker\Generator as Faker;
use App\Enums\KategoriRegistrasi;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Fasilitas\Ranjang;
use App\Enums\CaraPenerimaan;
use App\Enums\Aktifitas;

$factory->define(Perawatan\RawatJalan::class, function (Faker $faker) {
    return [
        'kunjungan_id' => function () {
            return factory(Kunjungan::class)->create()->id;
        },
        'jenis_registrasi_id' => function () {
            return factory(Master\JenisRegistrasi::class)->create([
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

$factory->define(Perawatan\RawatDarurat::class, function (Faker $faker) {
    return [
        'kunjungan_id' => function () {
            return factory(Kunjungan::class)->create()->id;
        },
        'jenis_registrasi_id' => function () {
            return factory(Master\JenisRegistrasi::class)->create([
                'kategori' => KategoriRegistrasi::GAWAT_DARURAT
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

$factory->define(Perawatan\RawatInap::class, function (Faker $faker) {
    return [
        'kunjungan_id' => function () {
            return factory(Kunjungan::class)->create()->id;
        },
        'jenis_registrasi_id' => function () {
            return factory(Master\JenisRegistrasi::class)->create([
                'kategori' => KategoriRegistrasi::RAWAT_INAP
            ])->id;
        },
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'ranjang_id' => function () {
            return factory(Ranjang::class)->create()->id;
        },
        'cara_penerimaan' => CaraPenerimaan::getRandomValue(),
        'aktifitas'       => Aktifitas::getRandomValue()
    ];
});
