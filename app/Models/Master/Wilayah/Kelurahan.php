<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;

class Kelurahan extends Master
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['kecamatan'];

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
    protected $searchable = ['name', 'kecamatan', 'kecamatan_id'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function searchKecamatan($builder, $searchQuery)
    {
        return $builder->orwhereHas('kecamatan', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }

    public function scopeWithParent($builder)
    {
        return $builder
            ->join('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
            ->join('kota_kabupatens', 'kecamatans.kota_kabupaten_id', '=', 'kota_kabupatens.id')
            ->select('kelurahans.*', 'kecamatans.name as kecamatan_name', 'kota_kabupatens.name as kota_kabupaten_name');
    }

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }
}
