<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Layanan\Tindakan;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Master\TindakanPemeriksaan;

class TindakanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Tindakan::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_tindakan_pemeriksaan()
    {
        $resource = factory(Tindakan::class)->create();

        $this->assertInstanceOf(TindakanPemeriksaan::class, $resource->tindakan_pemeriksaan);
    }
}
