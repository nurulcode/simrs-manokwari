<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas;

class RanjangTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_kamar()
    {
        $ranjang = factory(Fasilitas\Ranjang::class)->create();

        $this->assertInstanceof(Fasilitas\Kamar::class, $ranjang->kamar);
    }

    /** @test */
    public function a_ranjang_have_virtual_ruangan_id()
    {
        $ranjang = factory(Fasilitas\Ranjang::class)->create();

        $ranjang = Fasilitas\Ranjang::find($ranjang->id);

        $this->assertSame($ranjang->kamar->ruangan_id, $ranjang->ruangan_id);
    }

    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $ranjang = factory(Fasilitas\Ranjang::class)->create();

        $ranjang = Fasilitas\Ranjang::find($ranjang->id);

        $this->assertInstanceof(Fasilitas\Ruangan::class, $ranjang->ruangan);
    }

    /** @test */
    public function a_ranjang_have_virtual_poliklinik_id()
    {
        $ranjang = factory(Fasilitas\Ranjang::class)->create();

        $ranjang = Fasilitas\Ranjang::find($ranjang->id);

        $this->assertSame(
            $ranjang->kamar->ruangan->poliklinik_id,
            $ranjang->poliklinik_id
        );
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $ranjang = factory(Fasilitas\Ranjang::class)->create();

        $ranjang = Fasilitas\Ranjang::find($ranjang->id);

        $this->assertInstanceof(Fasilitas\Poliklinik::class, $ranjang->poliklinik);
    }
}
