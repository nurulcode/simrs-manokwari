<?php

namespace App\Models\Layanan;

use App\Models\Model;
use App\Models\Kepegawaian\BelongsToPegawai;

class Layanan extends Model
{
    use BelongsToPegawai;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu'];

    public function perawatan()
    {
        return $this->morphTo();
    }
}
