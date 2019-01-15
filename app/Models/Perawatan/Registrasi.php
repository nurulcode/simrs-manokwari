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
        'kunjungan_id', 'perawatan_id', 'perawatan_type', 'jenis_registrasi_id'
    ];

    public function perawatan()
    {
        return $this->morphTo();
    }
}
