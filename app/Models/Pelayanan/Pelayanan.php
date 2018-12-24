<?php

namespace App\Models\Pelayanan;

use App\Models\Kunjungan;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['layanan', 'kunjungan'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kunjungan_id', 'layanan_id', 'layanan_type'
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function layanan()
    {
        return $this->morphTo();
    }
}
