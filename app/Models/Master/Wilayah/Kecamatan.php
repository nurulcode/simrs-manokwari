<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;

class Kecamatan extends Master
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['kota_kabupaten'];

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
    protected $fillable = ['name', 'kota_kabupaten_id'];

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['name', 'kota_kabupaten', 'kota_kabupaten_id'];

    public function kota_kabupaten()
    {
        return $this->belongsTo(KotaKabupaten::class);
    }

    public function searchKotaKabupaten($builder, $searchQuery)
    {
        return $builder->orwhereHas('kota_kabupaten', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }

    public function scopeWithParent($builder)
    {
        return $builder
            ->join('kota_kabupatens', 'kecamatans.kota_kabupaten_id', '=', 'kota_kabupatens.id')
            ->join('provinsis', 'kota_kabupatens.provinsi_id', '=', 'provinsis.id')
            ->select('kecamatans.*', 'kota_kabupatens.name as kota_kabupaten_name', 'provinsis.name as provinsi_name');
    }

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }
}
