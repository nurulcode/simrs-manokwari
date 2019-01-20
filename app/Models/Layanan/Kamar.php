<?php

namespace App\Models\Layanan;

use App\Models\HasTarif;
use App\Models\Fasilitas\BelongsToRanjang;

class Kamar extends Layanan
{
    use BelongsToRanjang, HasTarif;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_kamars';

    public function path($action = 'show')
    {
        return;
    }

    public function getTarifReference()
    {
        return $this->ranjang->ruangan;
    }

    public function getTarifKelas()
    {
        return $this->ranjang->kelas;
    }
}
