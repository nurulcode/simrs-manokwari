<?php

namespace App;

use App\Models\Kunjungan;
use App\Models\RawatJalan;

class RegistrasiRawatJalan
{
    public static function create(array $data)
    {
        $perawatan = RawatJalan::create(array_only($data, ['kegiatan_id', 'poliklinik_id']));

        $kunjungan = Kunjungan::create(array_except($data, ['kegiatan_id', 'poliklinik_id']));

        $kunjungan->pelayanans()->create([
            'layanan_id'   => $perawatan->id,
            'layanan_type' => get_class($perawatan)
        ]);

        return $kunjungan;
    }
}
