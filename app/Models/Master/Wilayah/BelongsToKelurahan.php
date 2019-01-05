<?php

namespace App\Models\Master\Wilayah;

/**
 * Belongs to Kelurahan
 */
trait BelongsToKelurahan
{
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
