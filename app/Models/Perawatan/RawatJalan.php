<?php

namespace App\Models\Perawatan;

use App\Models\Model;
use App\Models\Kunjungan;
use App\Models\Fasilitas\Poliklinik;

class RawatJalan extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['poliklinik'];

    protected static function boot()
    {
        parent::boot();

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

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}
