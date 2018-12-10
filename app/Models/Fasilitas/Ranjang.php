<?php

namespace App\Models\Fasilitas;

use App\Models\Model;

class Ranjang extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['kamar'];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function scopeWithKamar($builder)
    {
        return $builder
            ->join('kamars', 'ranjangs.kamar_id', '=', 'kamars.id')
            ->join('ruangans', 'kamars.ruangan_id', '=', 'ruangans.id')
            ->select('ranjangs.*', 'kamars.nama as nama_kamar', 'ruangans.nama as nama_ruangan');
    }
}
