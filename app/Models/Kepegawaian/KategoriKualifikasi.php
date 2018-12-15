<?php

namespace App\Models\Kepegawaian;

use App\Models\Model;

class KategoriKualifikasi extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tenaga_medis' => 'boolean',
    ];
}
