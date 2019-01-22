<?php

namespace App\Models\Perawatan;

use Carbon\Carbon;
use App\Models\Layanan\HasLayananKamar;
use Illuminate\Database\Eloquent\Builder;

class RawatInap extends Perawatan
{
    use HasLayananKamar;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['pulang'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cara_penerimaan',
        'kegiatan_id',
        'waktu_masuk',
        'waktu_keluar',
        'kondisi_akhir',
        'aktifitas',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('waktu_keluar', function (Builder $builder) {
            $builder->addSubSelect('waktu_keluar', RawatInapPulang::select('waktu_keluar')
                ->whereColumn('rawat_inap_id', 'rawat_inaps.id'));
        });
    }

    public function scopeHariIni($query)
    {
        return $query->hari(Carbon::now());
    }

    public function scopeHari($query, $date)
    {
        if (!$date instanceof Carbon) {
            $date = new Carbon($date);
        }

        return $query->whereBetween('waktu_masuk', [
            $date->startOfDay(), $date->copy()->endOfDay()
        ]);
    }

    public function pulang()
    {
        return $this->hasOne(RawatInapPulang::class);
    }
}
