<?php

use App\Models\Master;
use App\Models\Pelayanan;
use Faker\Generator as Faker;
use App\Enums\KategoriRegistrasi;
use App\Models\Fasilitas\Poliklinik;

$factory->define(Pelayanan\RawatJalan::class, function (Faker $faker) {
    return [
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
