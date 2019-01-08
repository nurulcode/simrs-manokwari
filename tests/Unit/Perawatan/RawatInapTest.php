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
    public function a_rawatinap_have_virtual_kamar_id()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertSame($rawatinap->ranjang->kamar_id, $rawatinap->kamar_id);
    }

    /** @test */
    public function resource_belongs_to_kamar()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $this->assertInstanceof(Kamar::class, $rawatinap->kamar);
    }

    /** @test */
    public function a_rawatinap_have_virtual_ruangan_id()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertSame($rawatinap->kamar->ruangan_id, $rawatinap->ruangan_id);
    }

    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertInstanceof(Ruangan::class, $rawatinap->ruangan);
    }

    /** @test */
    public function a_rawatinap_have_virtual_poliklinik_id()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertSame($rawatinap->kamar->ruangan->poliklinik_id, $rawatinap->poliklinik_id);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertInstanceof(Poliklinik::class, $rawatinap->poliklinik);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource = factory(RawatInap::class)->create();

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }
}
