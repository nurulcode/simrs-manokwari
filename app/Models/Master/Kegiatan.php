<?php

namespace App\Models\Master;

class Kegiatan extends Master
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['kategori', 'parent'];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function kategori()
    {
        return $this->belongsToMany(KategoriKegiatan::class)->withPivot('kode');
    }
}
