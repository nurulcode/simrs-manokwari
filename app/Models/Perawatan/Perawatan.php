<?php

namespace App\Models\Perawatan;

use App\Models\Model;
use App\Models\HasKunjungan;
use App\Models\Master\Kegiatan;

abstract class Perawatan extends Model
{
    use HasKunjungan;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu_masuk'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded;

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
