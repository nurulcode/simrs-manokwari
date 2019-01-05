<?php

namespace App\Models;

use App\Models\Master\Wilayah\Kelurahan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\Wilayah\BelongsToKelurahan;
use App\Models\Master\Wilayah\BelongsToKecamatan;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\BelongsToKotaKabupaten;
use App\Models\Master\Wilayah\KotaKabupaten;
use App\Models\Master\Wilayah\BelongsToProvinsi;

class Pasien extends Model
{
    use SoftDeletes,
        BelongsToProvinsi,
        BelongsToKotaKabupaten,
        BelongsToKecamatan,
        BelongsToKelurahan;

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

        static::addGlobalScope('kecamatan', function (Builder $builder) {
            $builder->addSubSelect('kecamatan_id',
                Kelurahan::withoutGlobalScopes(['provinsi', 'kota_kabupaten'])
                    ->select('kecamatan_id')
                    ->whereColumn('id', 'pasiens.kelurahan_id'));
        });

        static::addGlobalScope('kota_kabupaten', function (Builder $builder) {
            $kecamatan = Kecamatan::withoutGlobalScope('provinsi')
                ->select('kota_kabupaten_id')
                ->whereColumn('id', 'kelurahans.kecamatan_id');
            $kelurahan = Kelurahan::getQuery()
                ->whereColumn('id', 'pasiens.kelurahan_id')
                ->selectSub($kecamatan, 'kota_kabupaten_id');

            $builder->addSubSelect('kota_kabupaten_id', $kelurahan);
        });

        static::addGlobalScope('provinsi', function (Builder $builder) {
            $kotakab = KotaKabupaten::getQuery()
                ->select('provinsi_id')
                ->whereColumn('id', 'kecamatans.kota_kabupaten_id');
            $kecamatan = Kecamatan::withoutGlobalScope('provinsi')
                ->whereColumn('id', 'kelurahans.kecamatan_id')
                ->selectSub($kotakab, 'provinsi_id');
            $kelurahan = Kelurahan::getQuery()
                ->whereColumn('id', 'pasiens.kelurahan_id')
                ->selectSub($kecamatan, 'provinsi_id');

            $builder->addSubSelect('provinsi_id', $kelurahan);
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
