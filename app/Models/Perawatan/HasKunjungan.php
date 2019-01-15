<?php

namespace App\Models\Perawatan;

use App\Models\Kunjungan;

trait HasKunjungan
{
    protected static function bootHasKunjungan()
    {
        static::creating(function ($model) {
            if (empty($model->waktu_kunjungan)) {
                $model->waktu_kunjungan = now();
            }
        });

        static::created(function ($model) {
            $model->registrasi()->create([
                'kunjungan_id'        => $model->kunjungan_id,
                'jenis_registrasi_id' => $model->jenis_registrasi_id
            ]);
        });
    }

    public function registrasi()
    {
        return $this->morphOne(Registrasi::class, 'perawatan');
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}
