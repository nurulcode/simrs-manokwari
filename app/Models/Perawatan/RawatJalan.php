<?php

namespace App\Models\Perawatan;

use Carbon\Carbon;
use App\Models\Model;
use App\Models\Fasilitas\Poliklinik;

class RawatJalan extends Model
{
    use HasKunjungan, HasDiagnosa;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu_kunjungan'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kegiatan_id', 'poliklinik_id', 'jenis_registrasi_id', 'waktu_kunjungan'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded;

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }

    public function scopeHariIni($query)
    {
        return $query->hari(Carbon::now());
    }

    public function scopeHari($query, $date)
    {
        if (!$date instanceof Carbon) {
            $date = new Carbon($date);
        }

        return $query->whereBetween('waktu_kunjungan', [
            $date->startOfDay(), $date->copy()->endOfDay()
        ]);
    }
}
