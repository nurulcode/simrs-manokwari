<?php

namespace Tests\Unit\Master\Penyait;

use Tests\TestCase;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

class KelompokPenyakitTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_klasifikasi()
    {
        $kelompok = factory(KelompokPenyakit::class)->create();

        $this->assertInstanceof(KlasifikasiPenyakit::class, $kelompok->klasifikasi);
    }
}
