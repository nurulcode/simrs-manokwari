<?php

namespace App\Models\Layanan;

use App\Models\Logistik\Logistik;

class Resep extends Layanan
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_reseps';

    public function obat()
    {
        return $this->belongsTo(Logistik::class);
    }

    public function details()
    {
        return $this->hasMany(ResepDetail::class);
    }
}
