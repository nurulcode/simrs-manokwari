<?php

namespace Tests\Unit\Perawatan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Fasilitas\Ranjang;
use App\Models\Perawatan\RawatInap;

class RawatInapTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_ranjang()
    {
        $resource = factory(RawatInap::class)->create();

        $this->assertInstanceof(Ranjang::class, $resource->ranjang);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource = factory(RawatInap::class)->create();

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }
}
