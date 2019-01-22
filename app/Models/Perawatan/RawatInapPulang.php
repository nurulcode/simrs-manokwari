<?php

namespace App\Models\Perawatan;

use Illuminate\Database\Eloquent\Model;

class RawatInapPulang extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rawat_inap_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->load('rawat_inap.layanan_kamar', 'rawat_inap.kunjungan');

            $kamar     = $model->rawat_inap->layanan_kamar;

            $kunjungan = $model->rawat_inap->kunjungan;

            $kamar->waktu_keluar = $model->waktu_keluar;

            $kamar->save();

            $kunjungan->waktu_keluar = $model->waktu_keluar;

            $kunjungan->save();
        });
    }

    public function rawat_inap()
    {
        return $this->belongsTo(RawatInap::class);
    }
}