<?php

namespace Tests\Unit\Perawatan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Perawatan\RawatJalan;

class RawatJalanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = factory(RawatJalan::class)->create();

        $this->assertInstanceof(Poliklinik::class, $resource->poliklinik);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource  = factory(RawatJalan::class)->create();

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }
}
