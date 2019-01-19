<?php

namespace App\Models\Perawatan;

use Carbon\Carbon;
use App\Models\Layanan\HasLayananKamar;

class RawatInap extends Perawatan
{
    use HasLayananKamar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cara_penerimaan',
        'kegiatan_id',
        'waktu_masuk',
        'waktu_keluar',
        'kondisi_akhir',
        'aktifitas',
    ];

    public function scopeHariIni($query)
    {
        return $query->hari(Carbon::now());
    }

    public function scopeHari($query, $date)
    {
        if (!$date instanceof Carbon) {
            $date = new Carbon($date);
        }

        return $query->whereBetween('waktu_masuk', [
            $date->startOfDay(), $date->copy()->endOfDay()
        ]);
    }
}
