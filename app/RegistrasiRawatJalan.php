<?php

namespace App;

use App\Models\Kunjungan;

class RegistrasiRawatJalan
{
    public static function create(array $data)
    {
        $kunjungan = Kunjungan::create(array_except($data, [
            'kegiatan_id', 'poliklinik_id', 'jenis_registrasi_id'
        ]));

        $kunjungan->rawat_jalans()->create(array_only($data, [
            'kegiatan_id', 'poliklinik_id', 'jenis_registrasi_id', 'waktu_kunjungan'
        ]));

        return $kunjungan;
    }
}
