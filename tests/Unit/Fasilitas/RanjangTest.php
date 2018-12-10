<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ranjang;

class RanjangTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_kamar()
    {
        $ranjang = factory(Ranjang::class)->create();

        $this->assertInstanceof(Kamar::class, $ranjang->kamar);
    }
}
