<?php

namespace App\Models\Fasilitas;

/**
 * Belongs to Kamar
 */
trait BelongsToKamar
{
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function orderByKamar($builder, $direction = 'asc')
    {
        $kamar = Kamar::withoutGlobalScope('poliklinik')
            ->select('nama')
            ->whereColumn('id', 'kamar_id');

        $builder->orderBySub($kamar, $direction);

        return $builder;
    }
}
