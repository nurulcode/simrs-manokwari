<?php

namespace App\Models\Master;

class Kegiatan extends Master
{
    public function kategori()
    {
        return $this->belongsToMany(KategoriKegiatan::class);
    }
}
