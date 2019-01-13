<?php

namespace App\Models\Layanan;

use App\Models\Model as BaseModel;
use App\Models\Kepegawaian\BelongsToPegawai;

class Model extends BaseModel
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
