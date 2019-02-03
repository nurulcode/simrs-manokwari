<?php

namespace App\Models\Logistik;

use App\Models\Model;

class Penerimaan extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['tanggal_faktur', 'jatuh_tempo', 'tanggal_terima'];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
}
