<?php

namespace Tests\Unit\Master\Wilayah;

use Tests\TestCase;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;

class KelurahanTest extends TestCase
{
    /** @test */
    public function a_kelurahan_belongs_to_kecamatan()
    {
        $kelurahan = factory(Kelurahan::class)->create();

        $this->assertInstanceof(Kecamatan::class, $kelurahan->kecamatan);
    }
}
