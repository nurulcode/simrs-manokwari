<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;
use Illuminate\Database\Eloquent\Builder;

class Kelurahan extends Master
{
    use BelongsToProvinsi, BelongsToKotaKabupaten, BelongsToKecamatan;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'kecamatan_id'];

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['name', 'parent'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('provinsi', function (Builder $builder) {
            $kotakab   = KotaKabupaten::select('provinsi_id')
                ->whereColumn('id', 'kecamatans.kota_kabupaten_id');
            $kecamatan = Kecamatan::getQuery()
                ->whereColumn('id', 'kelurahans.kecamatan_id')
                ->selectSub($kotakab, 'provinsi_id');

            $builder->addSubSelect('provinsi_id', $kecamatan);
        });

        static::addGlobalScope('kota_kabupaten', function (Builder $builder) {
            $builder->addSubSelect('kota_kabupaten_id', Kecamatan::withoutGlobalScope('provinsi')
                ->select('kota_kabupaten_id')
                ->whereColumn('id', 'kelurahans.kecamatan_id'));
        });
    }

    public function afterOrder($builder, $orderBy, $orderDirection)
    {
        switch ($orderBy) {
            case 'provinsi':
                $builder = $this->orderByKotaKabupaten($builder, $orderDirection);
                // no break
            case 'kota_kabupaten':
                $builder = $this->orderByKecamatan($builder, 'asc');
                // no break
            case 'kecamatan':
                $builder = $builder->orderBy('name', 'asc');
                break;
        }

        return $builder;
    }

    public function searchParent($builder, $searchQuery)
    {
        return $builder->orwhereHas('kecamatan', function ($query) use ($searchQuery) {
            $query
                ->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhereExists(function ($query) use ($searchQuery) {
                    $query->select('*')
                        ->from('kota_kabupatens')
                        ->whereRaw('kota_kabupatens.id = kecamatans.kota_kabupaten_id')
                        ->where(function ($query) use ($searchQuery) {
                            $query
                                ->where('name', 'like', '%' . $searchQuery . '%')
                                ->orWhereExists(function ($query) use ($searchQuery) {
                                    $query->select('*')
                                        ->from('provinsis')
                                        ->whereRaw('kota_kabupatens.provinsi_id = provinsis.id')
                                        ->where('name', 'like', '%' . $searchQuery . '%');
                                });
                        });
                });
        });
    }
}
