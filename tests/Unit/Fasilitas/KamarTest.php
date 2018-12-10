<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ruangan;

class KamarTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $kamar = factory(Kamar::class)->create();

        $this->assertInstanceof(Ruangan::class, $kamar->ruangan);
    }
}
