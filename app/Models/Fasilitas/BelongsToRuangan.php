<?php

namespace App\Models\Fasilitas;

/**
 * Belongs to Ruangan
 */
trait BelongsToRuangan
{
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function searchRuangan($builder, $searchQuery)
    {
        return $builder->orwhereHas('ruangan', function ($query) use ($searchQuery) {
            $query->where('nama', 'like', '%' . $searchQuery . '%')
                ->orWhere('kode', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByRuangan($builder, $direction = 'asc')
    {
        $ruangan = Ruangan::select('nama')->whereColumn('id', 'ruangan_id');

        $builder->orderBySub($ruangan, $direction);

        return $builder;
    }
}
