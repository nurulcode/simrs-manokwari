<?php

namespace App\Models\Fasilitas;

use App\Models\Model;

class Kamar extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['ruangan'];

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
    protected $fillable = ['nama', 'ruangan_id'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function scopeWithRuangan($builder)
    {
        return $builder
            ->join('ruangans', 'kamars.ruangan_id', '=', 'ruangans.id')
            ->select('kamars.*', 'ruangans.nama as nama_ruangan');
    }

    public function ranjangs()
    {
        return $this->hasMany(Ranjang::class);
    }
}
