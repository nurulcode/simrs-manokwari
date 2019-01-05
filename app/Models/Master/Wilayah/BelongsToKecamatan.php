<?php

namespace App\Models\Master\Wilayah;

/**
 * Belongs to Kecamatan
 */
trait BelongsToKecamatan
{
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function searchKecamatan($builder, $searchQuery)
    {
        return $builder->orwhereHas('kecamatan', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByKecamatan($builder, $direction = 'asc')
    {
        $kecamatan_name = Kecamatan::withoutGlobalScope('provinsi')
            ->select('name')
            ->whereColumn('id', 'kecamatan_id');

        $builder->orderBySub($kecamatan_name, $direction);

        return $builder;
    }
}
