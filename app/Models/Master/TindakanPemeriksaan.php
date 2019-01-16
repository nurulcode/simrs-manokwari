<?php

namespace App\Models\Master;

use App\Models\HasTarif;
use App\Models\BelongsToItself;
use App\Models\Fasilitas\Poliklinik;

class TindakanPemeriksaan extends Master
{
    use BelongsToItself, HasTarif;

    public function polikliniks()
    {
        return $this->belongsToMany(Poliklinik::class);
    }
}
