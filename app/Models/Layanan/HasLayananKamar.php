<?php

namespace App\Models\Layanan;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Fasilitas\BelongsToRanjang;

trait HasLayananKamar
{
    use BelongsToRanjang;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function bootHasLayananKamar()
    {
        static::addGlobalScope('kamar', function (Builder $builder) {
            $columns = [
                'layanan_kamars.ranjang_id',
                'kamar_id',
                'ruangan_id',
                'poliklinik_id',
                'kelas',
                'perawatan_id'
            ];

            $kamar = Kamar::select($columns)
                ->whereNull('waktu_keluar')
                ->where('perawatan_type', self::class);

            $builder
                ->addSelect([
                    'ranjang_id',
                    'kamar_id',
                    'ruangan_id',
                    'poliklinik_id',
                    'kelas',
                ])
                ->leftJoinSub($kamar, 'ranjang', function ($join) {
                    $join->on('id', 'ranjang.perawatan_id');
                });
        });
    }

    public function kamars()
    {
        return $this->morphMany(Kamar::class, 'perawatan');
    }

    /**
     * Disable "booting" method of the BelongsToRanjang trait.
     *
     * @return void
     */
    public static function bootBelongsToRanjang()
    {
        // Do nothing
    }
}
