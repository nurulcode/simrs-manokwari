<?php

namespace App\Models\Master;

use App\Models\Tarifable;
use App\Enums\KelasTarif;

class JenisRegistrasi extends Master
{
    use Tarifable;

    public function getKelasTarifAttribute($value)
    {
        return [KelasTarif::UMUM];
    }
}
