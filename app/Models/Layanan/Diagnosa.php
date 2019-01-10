<?php

namespace App\Models\Layanan;

use App\Models\Model;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Master\TipeDiagnosa;
use App\Models\Master\Penyakit\Penyakit;

class Diagnosa extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['penyakit', 'petugas', 'tipe'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu'];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function tipe()
    {
        return $this->belongsTo(TipeDiagnosa::class, 'tipe_diagnosa_id');
    }
}
