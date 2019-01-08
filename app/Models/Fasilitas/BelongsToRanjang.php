<?php

namespace App\Models\Fasilitas;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to ranjang
 */
trait BelongsToRanjang
{
    public static function bootBelongsToRanjang()
    {
        $table = with(new static)->getTable();

        static::addGlobalScope('kamar', function (Builder $builder) use ($table) {
            $builder->addSubSelect('kamar_id',
                Ranjang::select('kamar_id')->whereColumn('id', $table . '.ranjang_id')
            );
        });
    }
}
