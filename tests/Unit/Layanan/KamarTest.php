<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Fasilitas;
use App\Models\Layanan\Kamar;
use App\Models\Perawatan\Perawatan;

class KamarTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_ranjang()
    {
        $resource = factory(Kamar::class)->create();

        $this->assertInstanceof(Fasilitas\Ranjang::class, $resource->ranjang);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Kamar::class)->create();

        $this->assertInstanceof(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function a_resource_have_virtual_kamar_id()
    {
        $resource = factory(Kamar::class)->create();

        $resource = Kamar::find($resource->id);

        $this->assertSame($resource->ranjang->kamar_id, $resource->kamar_id);
    }

    /** @test */
    public function resource_belongs_to_kamar()
    {
        $resource = factory(Kamar::class)->create();

        $resource = Kamar::find($resource->id);

        $this->assertInstanceof(Fasilitas\Kamar::class, $resource->kamar);
    }

    /** @test */
    public function a_resource_have_virtual_ruangan_id()
    {
        $resource = factory(Kamar::class)->create();

        $resource = Kamar::find($resource->id);

        $this->assertSame(
            $resource->ranjang->kamar->ruangan_id,
            $resource->ruangan_id
        );
    }

    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $resource = factory(Kamar::class)->create();

        $resource = Kamar::find($resource->id);

        $this->assertInstanceof(Fasilitas\Ruangan::class, $resource->ruangan);
    }

    /** @test */
    public function a_resource_have_virtual_kelas()
    {
        $resource = factory(Kamar::class)->create();

        $resource = Kamar::find($resource->id);

        $this->assertSame(
            $resource->ranjang->kamar->ruangan->kelas,
            $resource->kelas
        );
    }

    /** @test */
    public function a_resource_have_virtual_poliklinik_id()
    {
        $resource = factory(Kamar::class)->create();

        $resource = Kamar::find($resource->id);

        $this->assertSame(
            $resource->ranjang->kamar->ruangan->poliklinik_id,
            $resource->poliklinik_id
        );
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = factory(Kamar::class)->create();

        $resource = Kamar::find($resource->id);

        $this->assertInstanceof(Fasilitas\Poliklinik::class, $resource->poliklinik);
    }
}
