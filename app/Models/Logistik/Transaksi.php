<?php

namespace App\Models\Logistik;

use App\Models\Model;
use App\Models\Fasilitas\Poliklinik;

class Transaksi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logistik_transaksis';

    public function jenis_transaksi()
    {
        return $this->morphTo();
    }

    public function apotek()
    {
        return $this->belongsTo(Poliklinik::class);
    }

    public function logistik()
    {
        return $this->belongsTo(Logistik::class);
    }
}
