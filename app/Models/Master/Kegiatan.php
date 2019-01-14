<?php

namespace App\Models\Master;

use App\Models\BelongsToItself;

class Kegiatan extends Master
{
    use BelongsToItself;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['kategori'];

    public function kategori()
    {
        return $this->belongsToMany(KategoriKegiatan::class)->withPivot('kode');
    }
}
