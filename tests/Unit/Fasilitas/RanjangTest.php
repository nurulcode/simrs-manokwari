<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ranjang;
use App\Models\Fasilitas\Ruangan;
use App\Models\Fasilitas\Poliklinik;

class RanjangTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_kamar()
    {
        $ranjang = factory(Ranjang::class)->create();

        $this->assertInstanceof(Kamar::class, $ranjang->kamar);
    }

    /** @test */
    public function a_ranjang_have_virtual_ruangan_id()
    {
        $ranjang = factory(Ranjang::class)->create();

        $ranjang = Ranjang::find($ranjang->id);

        $this->assertSame($ranjang->kamar->ruangan_id, $ranjang->ruangan_id);
    }

    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $ranjang = factory(Ranjang::class)->create();

        $ranjang = Ranjang::find($ranjang->id);

        $this->assertInstanceof(Ruangan::class, $ranjang->ruangan);
    }

    /** @test */
    public function a_ranjang_have_virtual_poliklinik_id()
    {
        $ranjang = factory(Ranjang::class)->create();

        $ranjang = Ranjang::find($ranjang->id);

        $this->assertSame($ranjang->kamar->ruangan->poliklinik_id, $ranjang->poliklinik_id);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $ranjang = factory(Ranjang::class)->create();

        $ranjang = Ranjang::find($ranjang->id);

        $this->assertInstanceof(Poliklinik::class, $ranjang->poliklinik);
    }
}
