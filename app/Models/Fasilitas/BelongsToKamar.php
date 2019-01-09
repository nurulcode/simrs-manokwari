<?php

namespace App\Models\Fasilitas;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to Kamar
 */
trait BelongsToKamar
{
    use BelongsToRuangan;

    public static function bootBelongsToRuangan()
    {
        // Do nothing
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootBelongsToKamar()
    {
        static::addGlobalScope('ruangan', function (Builder $builder) {
            $kamar = Kamar::selectRaw('id as kamar_id, ruangan_id');

            $builder->joinSub($kamar, 'kamar', function ($join) {
                $join->on('ranjangs.kamar_id', '=', 'kamar.kamar_id');
            });
        });
    }

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
