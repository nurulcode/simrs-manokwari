<?php

namespace App\Models\Perawatan;

use Carbon\Carbon;
use App\Enums\KelasTarif;
use App\Models\Layanan\HasLayananDiagnosa;
use App\Models\Fasilitas\BelongsToPoliklinik;

class RawatJalan extends Perawatan
{
    use HasLayananDiagnosa, BelongsToPoliklinik;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kegiatan_id', 'poliklinik_id', 'waktu_masuk'
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

    public function getKelasAttribute()
    {
        return KelasTarif::getKey(KelasTarif::TARIF_UMUM);
    }
}
