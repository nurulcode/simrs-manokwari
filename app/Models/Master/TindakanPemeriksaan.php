<?php

namespace App\Models\Master;

use App\Models\Tarif;
use App\Models\Fasilitas\Poliklinik;

class TindakanPemeriksaan extends Master
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['parent'];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

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
