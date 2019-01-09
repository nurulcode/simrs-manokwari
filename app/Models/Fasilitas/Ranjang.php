<?php

namespace App\Models\Fasilitas;

use App\Models\Model;

class Ranjang extends Model
{
    use BelongsToKamar;

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['kode', 'parent'];

    public function afterOrder($builder, $orderBy, $orderDirection)
    {
        switch ($orderBy) {
            case 'poliklinik':
                $builder = $this->orderByRuangan($builder, $orderDirection);
                // no break
            case 'ruangan':
                $builder = $this->orderByKamar($builder, $orderDirection);
                // no break
            case 'kamar':
                $builder = $builder->orderBy('kode', 'asc');
                break;
        }

        return $builder;
    }

    public function searchParent($builder, $searchQuery)
    {
        return $builder->orwhereHas('kamar', function ($query) use ($searchQuery) {
            $query
                ->where('kode', 'like', '%' . $searchQuery . '%')
                ->orWhereExists(function ($query) use ($searchQuery) {
                    $query->select('*')
                        ->from('ruangans')
                        ->whereRaw('ruangans.id = kamars.ruangan_id')
                        ->where(function ($query) use ($searchQuery) {
                            $query
                                ->where('nama', 'like', '%' . $searchQuery . '%')
                                ->orWhere('kode', 'like', '%' . $searchQuery . '%')
                                ->orWhereExists(function ($query) use ($searchQuery) {
                                    $query->select('*')
                                        ->from('polikliniks')
                                        ->whereRaw('ruangans.poliklinik_id = polikliniks.id')
                                        ->where('nama', 'like', '%' . $searchQuery . '%');
                                });
                        });
                });
        });
    }
}
