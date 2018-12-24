<?php

namespace App\Models;

use App\Models\Perawatan\RawatJalan;
use App\Models\Master\Penyakit\Penyakit;

class Kunjungan extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['pasien_baru' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu_kunjungan'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['rujukan'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['pasien', 'penyakit'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->waktu_kunjungan)) {
                $model->waktu_kunjungan = now();
            }
        });

        static::created(function ($model) {
            if (empty($model->nomor_kunjungan)) {
                $model->nomor_kunjungan = str_pad($model->id, 8, 0, STR_PAD_LEFT);
            }

            $model->save();
        });
    }

    public function getRujukanAttribute()
    {
        return [
            'jenis_id' => $this->attributes['jenis_rujukan_id'],
            'asal'     => $this->attributes['rujukan_asal'],
            'nomor'    => $this->attributes['rujukan_nomor'],
            'tanggal'  => $this->attributes['rujukan_tanggal'],
        ];
    }

    public function setRujukanAttribute($value)
    {
        $this->attributes['jenis_rujukan_id'] = $value['jenis_id'];
        $this->attributes['rujukan_asal']     = $value['asal'];
        $this->attributes['rujukan_nomor']    = $value['nomor'];
        $this->attributes['rujukan_tanggal']  = $value['tanggal'];
    }

    public function rawat_jalans()
    {
        return $this->hasMany(RawatJalan::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
