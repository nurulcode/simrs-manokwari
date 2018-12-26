<?php

namespace App\Models\Perawatan;

use App\Models\Layanan\Diagnosa;

trait HasDiagnosa
{
    public function diagnosa()
    {
        return $this->morphMany(Diagnosa::class, 'perawatan');
    }
}
