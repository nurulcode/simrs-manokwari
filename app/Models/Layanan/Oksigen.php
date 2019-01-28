<?php

namespace App\Models\Layanan;

use App\Models\Master;
use App\Models\HasTarif;
use App\Enums\KelasTarif;
use Illuminate\Database\Eloquent\Model;

class Oksigen extends Layanan
{
    use HasTarif;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_oksigens';

    public function oksigen()
    {
        return $this->belongsTo(Master\Oksigen::class);
    }

    public function getTarifReference()
    {
        return $this->oksigen;
    }

    public function getTarifKelas()
    {
        return KelasTarif::getKey((string) $this->perawatan->kelas);
    }
}
