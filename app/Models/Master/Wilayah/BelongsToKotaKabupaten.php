<?php

namespace App\Models\Master\Wilayah;

/**
 * Belongs to kota kabupaten
 */
trait BelongsToKotaKabupaten
{
    public function kota_kabupaten()
    {
        return $this->belongsTo(KotaKabupaten::class);
    }

    public function searchKotaKabupaten($builder, $searchQuery)
    {
        return $builder->orwhereHas('kota_kabupaten', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByKotaKabupaten($builder, $direction = 'asc')
    {
        $kota_kabupaten_name = KotaKabupaten::select('name')
            ->whereColumn('id', 'kota_kabupaten_id');

        $builder->orderBySub($kota_kabupaten_name, $direction);

        return $builder;
    }
}
