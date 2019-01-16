<?php

namespace App\Models\Layanan;

use App\Models\Master\TindakanPemeriksaan;

class Tindakan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_tindakans';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $master = $model->tindakan_pemeriksaan;
            $kelas  = $model->perawatan->kelas;

            $model->tarif = $master->getTarifByKelas($kelas);
        });
    }

    public function tindakan_pemeriksaan()
    {
        return  $this->belongsTo(TindakanPemeriksaan::class);
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
