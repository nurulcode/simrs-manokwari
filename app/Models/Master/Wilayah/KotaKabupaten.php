<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;

class KotaKabupaten extends Master
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['provinsi'];

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['name', 'provinsi', 'provinsi_id'];

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

    public function scopeWithParent($builder)
    {
        return $builder
            ->join('provinsis', 'kota_kabupatens.provinsi_id', '=', 'provinsis.id')
            ->select('kota_kabupatens.*', 'provinsis.name as provinsi_name');
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }
}
