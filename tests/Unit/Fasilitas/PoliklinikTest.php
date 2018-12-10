<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Master\JenisPoliklinik;

class PoliklinikTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_jenis_poliklinik()
    {
        $poliklinik = factory(Poliklinik::class)->create();

        $this->assertInstanceof(JenisPoliklinik::class, $poliklinik->jenis);
    }
}
