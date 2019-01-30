<?php

namespace App\Models\Layanan;

use App\Models\Fasilitas\Poliklinik;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Fasilitas\BelongsToPoliklinik;
use App\Enums\TypePenunjang;

class Penunjang extends Layanan
{
    use BelongsToPoliklinik;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_penunjangs';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('jenis', function (Builder $builder) {
            $builder->addSubSelect('jenis',
                Poliklinik::withoutGlobalScopes()
                    ->select('jenis_id')
                    ->whereColumn('id', 'poliklinik_id')
            );
        });
    }

    public function getJenisAttribute($value)
    {
        return str_replace('_', '-', (strtolower(TypePenunjang::getKey((string) $value))));
    }

    public function getSlugAttribute()
    {
        return action('PenunjangViewController', [$this->jenis, $this->id]);
    }
}
