<?php

namespace App\Models\Perawatan;

use App\Models\Model;
use App\Models\Fasilitas\BelongsToRanjang;

class RawatInap extends Model
{
    use HasKunjungan, BelongsToRanjang;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu_kunjungan'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['ranjang'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kegiatan_id', 'ranjang_id', 'jenis_registrasi_id', 'waktu_kunjungan',
        'waktu_keluar', 'kondisi_akhir', 'cara_penerimaan', 'aktifitas'
    ];
}
