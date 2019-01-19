<?php

namespace App\Models\Layanan;

trait HasLayananKamar
{
    public function kamars()
    {
        return $this->morphMany(Kamar::class, 'perawatan');
    }

    public function kamar()
    {
        return $this->morphOne(Kamar::class, 'perawatan')->whereNull('waktu_keluar');
    }

    public function getPoliklinikAttribute()
    {
        return $this->kamar->poliklinik;
    }
}
