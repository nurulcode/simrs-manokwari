<?php

namespace App\Models\Fasilitas;

use App\Models\Model;

class Ruangan extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['poliklinik'];

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }
}
