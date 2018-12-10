<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Ruangan;
use App\Models\Fasilitas\Poliklinik;

class RuanganTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $ruangan = factory(Ruangan::class)->create();

        $this->assertInstanceof(Poliklinik::class, $ruangan->poliklinik);
    }
}
