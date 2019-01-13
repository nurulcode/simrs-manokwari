<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Layanan\Diagnosa;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Master\TipeDiagnosa;
use App\Models\Master\Penyakit\Penyakit;
use App\Models\Perawatan\RawatJalan;

class DiagnosaTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_penyakit()
    {
        $resource = factory(Diagnosa::class)->create();

        $this->assertInstanceOf(Penyakit::class, $resource->penyakit);
    }

    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Diagnosa::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_tipe()
    {
        $resource = factory(Diagnosa::class)->create();

        $this->assertInstanceOf(TipeDiagnosa::class, $resource->tipe);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Diagnosa::class)->create([
            'perawatan_type' => RawatJalan::class
        ]);

        $this->assertInstanceOf(RawatJalan::class, $resource->perawatan);
    }
}
