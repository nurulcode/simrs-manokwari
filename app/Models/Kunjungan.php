<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Perawatan\RawatInap;
use App\Models\Perawatan\RawatJalan;
use App\Models\Perawatan\RawatDarurat;
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cara_pembayaran_id', 'kasus_id',

        'pasien_baru', 'pasien_id', 'penyakit_id',

        'pj_nama', 'pj_telepon',

        'rujukan', 'jenis_rujukan_id', 'rujukan_asal', 'rujukan_nomor', 'rujukan_tanggal',

        'sjp_nomor', 'sjp_tanggal',

        'waktu_kunjungan', 'waktu_keluar'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded;

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

    public function rawat_darurats()
    {
        return $this->hasMany(RawatDarurat::class);
    }

    public function rawat_inaps()
    {
        return $this->hasMany(RawatInap::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function scopeHariIni($query)
    {
        return $query->hari(Carbon::now());
    }

    public function scopeHari($query, $date)
    {
        if (!$date instanceof Carbon) {
            $date = new Carbon($date);
        }

        return $query->whereBetween('waktu_kunjungan', [
            $date->startOfDay(), $date->copy()->endOfDay()
        ]);
    }
}
