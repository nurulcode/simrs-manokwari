<?php

namespace App\Models\Fasilitas;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to ranjang
 */
trait BelongsToRanjang
{
    use BelongsToKamar;

    public static function bootBelongsToKamar()
    {
        // Do nothing
    }

    public static function bootBelongsToRanjang()
    {
        $table = with(new static)->getTable();

        static::addGlobalScope('ranjang', function (Builder $builder) use ($table) {
            $ranjang = Ranjang::selectRaw(
                'id as ranjang_id, ranjangs.kamar_id, ruangan_id, poliklinik_id'
            );

            $builder->leftJoinSub($ranjang, 'ranjang', function ($join) use ($table) {
                $join->on($table . '.ranjang_id', '=', 'ranjang.ranjang_id');
            });
        });
    }

    public function ranjang()
    {
        return $this->belongsTo(Ranjang::class);
    }
}
