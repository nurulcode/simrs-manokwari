<?php

namespace App\Models\Perawatan;

use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kunjungan_id', 'perawatan_id', 'perawatan_type'
    ];

    public function perawatan()
    {
        return $this->morphTo();
    }
}
