<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\Wilayah\BelongsToKelurahan;

class Pasien extends Model
{
    use SoftDeletes, BelongsToKelurahan;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['tanggal_registrasi', 'tanggal_lahir'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            if (empty($model->no_rekam_medis)) {
                $model->no_rekam_medis = str_pad($model->id, 8, 0, STR_PAD_LEFT);
            }

            $model->save();
        });
    }

    public function jenis_identitas()
    {
        return $this->belongsTo(Master\JenisIdentitas::class);
    }

    public function agama()
    {
        return $this->belongsTo(Master\Agama::class);
    }

    public function suku()
    {
        return $this->belongsTo(Master\Suku::class);
    }

    public function pendidikan()
    {
        return $this->belongsTo(Master\Pendidikan::class);
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Master\Pekerjaan::class);
    }
}
