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
            $model->perawatan()->create(['kunjungan_id' => $model->kunjungan_id]);
        });
    }

    public function perawatan()
    {
        return $this->morphOne(Perawatan::class, 'perawatan');
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}
