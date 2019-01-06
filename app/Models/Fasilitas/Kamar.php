<?php

namespace App\Models\Fasilitas;

use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;

class Kamar extends Model
{
    use BelongsToPoliklinik, BelongsToRuangan;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'ruangan_id'];

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['nama', 'parent'];

    /**
    * The "booting" method of the model.
    *
    * @return void
    */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('poliklinik', function (Builder $builder) {
            $builder->addSubSelect('poliklinik_id', Ruangan::select('poliklinik_id')
                ->whereColumn('id', 'kamars.ruangan_id'));
        });
    }

    public function searchParent($builder, $searchQuery)
    {
        return $builder->orwhereHas('ruangan', function ($query) use ($searchQuery) {
            $query
                ->where('nama', 'like', '%' . $searchQuery . '%')
                ->orWhere('kode', 'like', '%' . $searchQuery . '%')
                ->orWhereExists(function ($query) use ($searchQuery) {
                    $query->select('*')
                        ->from('polikliniks')
                        ->whereRaw('ruangans.poliklinik_id = polikliniks.id')
                        ->where(function ($query) use ($searchQuery) {
                            $query->where('nama', 'like', '%' . $searchQuery . '%')
                                ->orWhere('kode', 'like', '%' . $searchQuery . '%');
                        });
                });
        });
    }

    public function afterOrder($builder, $orderBy, $orderDirection)
    {
        switch ($orderBy) {
            case 'poliklinik':
                $builder = $this->orderByRuangan($builder, $orderDirection);
                // no break
            case 'ruangan':
                $builder = $builder->orderBy('nama', 'asc');
                break;
        }

        return $builder;
    }

    public function ranjangs()
    {
        return $this->hasMany(Ranjang::class);
    }
}
