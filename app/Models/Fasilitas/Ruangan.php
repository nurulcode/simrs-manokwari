<?php

namespace App\Models\Fasilitas;

use App\Models\Model;

class Ruangan extends Model
{
    use BelongsToPoliklinik;

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['nama', 'kode', 'poliklinik'];

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }
}
