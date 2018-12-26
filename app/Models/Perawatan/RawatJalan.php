<?php

namespace App\Models\Perawatan;

use App\Models\Model;
use App\Models\Fasilitas\Poliklinik;

class RawatJalan extends Model
{
    use HasKunjungan, HasDiagnosa;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['poliklinik'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu_kunjungan'];

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }
}
