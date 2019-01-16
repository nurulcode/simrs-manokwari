<?php

namespace App\Models\Perawatan;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_registrasi_id',
        'kunjungan_id',
        'perawatan_id',
        'perawatan_type',
    ];

    public function perawatan()
    {
        return $this->morphTo();
    }
}
