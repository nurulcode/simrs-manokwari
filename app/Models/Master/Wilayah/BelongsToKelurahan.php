<?php

namespace App\Models\Master\Wilayah;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to Kelurahan
 */
trait BelongsToKelurahan
{
    use BelongsToProvinsi, BelongsToKotaKabupaten, BelongsToKecamatan;

    public static function bootBelongsToKelurahan()
    {
        $table = with(new static)->getTable();

        static::addGlobalScope('kecamatan', function (Builder $builder) use ($table) {
            $builder->addSubSelect('kecamatan_id',
                Kelurahan::withoutGlobalScopes(['provinsi', 'kota_kabupaten'])
                    ->select('kecamatan_id')
                    ->whereColumn('id', $table . '.kelurahan_id'));
        });

        static::addGlobalScope('kota_kabupaten', function (Builder $builder) use ($table) {
            $kecamatan = Kecamatan::withoutGlobalScope('provinsi')
                ->select('kota_kabupaten_id')
                ->whereColumn('id', 'kelurahans.kecamatan_id');
            $kelurahan = Kelurahan::getQuery()
                ->whereColumn('id', $table . '.kelurahan_id')
                ->selectSub($kecamatan, 'kota_kabupaten_id');

            $builder->addSubSelect('kota_kabupaten_id', $kelurahan);
        });

        static::addGlobalScope('provinsi', function (Builder $builder) use ($table) {
            $kotakab = KotaKabupaten::getQuery()
                ->select('provinsi_id')
                ->whereColumn('id', 'kecamatans.kota_kabupaten_id');
            $kecamatan = Kecamatan::withoutGlobalScope('provinsi')
                ->whereColumn('id', 'kelurahans.kecamatan_id')
                ->selectSub($kotakab, 'provinsi_id');
            $kelurahan = Kelurahan::getQuery()
                ->whereColumn('id', $table . '.kelurahan_id')
                ->selectSub($kecamatan, 'provinsi_id');

            $builder->addSubSelect('provinsi_id', $kelurahan);
        });
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function searchKelurahan($builder, $searchQuery)
    {
        return $builder->orwhereHas('kelurahan', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }
}
