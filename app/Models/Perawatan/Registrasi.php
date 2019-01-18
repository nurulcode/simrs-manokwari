<?php

namespace App\Models\Perawatan;

use App\Enums\KelasTarif;
use App\Models\Master\JenisRegistrasi;
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $master = $model->jenis;

            $model->tarif = $master->getTarifByKelas(KelasTarif::UMUM);
        });
    }

    public function perawatan()
    {
        return $this->morphTo();
    }

    public function jenis()
    {
        return $this->belongsTo(JenisRegistrasi::class, 'jenis_registrasi_id');
    }

    public function setTarifAttribute($value)
    {
        $this->attributes['tarif'] = json_encode($value);
    }

    public function getTarifAttribute($value)
    {
        return json_decode($value, true);
    }
}
