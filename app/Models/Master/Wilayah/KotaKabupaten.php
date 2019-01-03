<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;

class KotaKabupaten extends Master
{
    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['name', 'provinsi'];

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
    protected $fillable = ['name', 'provinsi_id'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function searchProvinsi($builder, $searchQuery)
    {
        return $builder->orwhereHas('provinsi', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByProvinsi($builder, $direction = 'asc')
    {
        $provinsi_name = Provinsi::select('name')->whereColumn('id', 'provinsi_id');

        $builder->orderBySub($provinsi_name, $direction);

        $builder->orderBy('name', 'asc');

        return $builder;
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }
}
