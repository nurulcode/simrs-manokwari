<?php

namespace App\Models\Master;

use App\Models\Tarif;
use App\Models\Fasilitas\Poliklinik;
use App\Models\BelongsToItself;

class TindakanPemeriksaan extends Master
{
    use BelongsToItself;

    public function polikliniks()
    {
        return $this->belongsToMany(Poliklinik::class);
    }

    public function tarif()
    {
        return $this->morphOne(Tarif::class, 'tarifable')->withDefault([
            'data' => with(new Tarif)->data
        ]);
    }
}
