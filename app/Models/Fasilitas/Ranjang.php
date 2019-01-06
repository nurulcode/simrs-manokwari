<?php

namespace App\Models\Fasilitas;

use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;

class Ranjang extends Model
{
    use BelongsToPoliklinik, BelongsToRuangan, BelongsToKamar;

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['kode', 'parent'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ruangan', function (Builder $builder) {
            $builder->addSubSelect('ruangan_id', Kamar::withoutGlobalScope('poliklinik')
            ->select('ruangan_id')
            ->whereColumn('id', 'ranjangs.kamar_id'));
        });

        static::addGlobalScope('poliklinik', function (Builder $builder) {
            $ruangan = Ruangan::select('poliklinik_id')
                ->whereColumn('id', 'kamars.ruangan_id');
            $kamar   = Kamar::getQuery()
                ->whereColumn('id', 'ranjangs.kamar_id')
                ->selectSub($ruangan, 'poliklinik_id');

            $builder->addSubSelect('poliklinik_id', $kamar);
        });
    }

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
