<?php

namespace App\Models\Layanan;

use App\Models\Master\TipeDiagnosa;
use App\Models\Master\Penyakit\Penyakit;

class Diagnosa extends Model
{
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function tipe()
    {
        return $this->belongsTo(TipeDiagnosa::class, 'tipe_diagnosa_id');
    }
}
