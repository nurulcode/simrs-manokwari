<?php

namespace App\Models\Fasilitas;

use App\Models\Model;
use App\Models\Master\JenisPoliklinik;

class Poliklinik extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['jenis'];

    public function jenis()
    {
        return $this->belongsTo(JenisPoliklinik::class);
    }

    public function ruangans()
    {
        return $this->hasMany(Ruangan::class);
    }
}
