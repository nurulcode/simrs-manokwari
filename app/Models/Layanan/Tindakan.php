<?php

namespace App\Models\Layanan;

use App\Models\Master\TindakanPemeriksaan;

class Tindakan extends Model
{
    public function tindakan_pemeriksaan()
    {
        return  $this->belongsTo(TindakanPemeriksaan::class);
    }
}
