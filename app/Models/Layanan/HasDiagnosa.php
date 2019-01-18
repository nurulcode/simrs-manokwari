<?php

namespace App\Models\Layanan;

trait HasDiagnosa
{
    public function diagnosa()
    {
        return $this->morphMany(Diagnosa::class, 'perawatan');
    }
}
