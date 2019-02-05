<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Layanan\Resep;
use App\Models\Logistik\Logistik;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Perawatan\Perawatan;

class ResepTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Resep::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Resep::class)->create();

        $this->assertInstanceof(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function resource_belongs_to_obat()
    {
        $resource = factory(Resep::class)->create();

        $this->assertInstanceof(Logistik::class, $resource->obat);
    }
}
