<?php

namespace Tests\Unit\Perawatan;

use Tests\TestCase;
use App\Models\Fasilitas;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use App\Models\Perawatan\RawatInap;

class RawatInapTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_ranjang()
    {
        $resource = factory(RawatInap::class)->create();

        $this->assertInstanceof(Fasilitas\Ranjang::class, $resource->ranjang);
    }

    /** @test */
    public function creating_resource_also_create_pivot_registrasis()
    {
        $resource  = factory(RawatInap::class)->create();

        $this->assertDatabaseHas('registrasis', [
            'kunjungan_id'        => $resource->kunjungan_id,
            'perawatan_id'        => $resource->id,
            'perawatan_type'      => get_class($resource),
            'jenis_registrasi_id' => $resource->jenis_registrasi_id
        ]);
    }

    /** @test */
    public function resource_belongs_to_registrasi()
    {
        $resource = factory(RawatInap::class)->create();

        $this->assertInstanceof(Registrasi::class, $resource->registrasi);
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

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertInstanceof(Fasilitas\Kamar::class, $rawatinap->kamar);
    }

    /** @test */
    public function a_rawatinap_have_virtual_ruangan_id()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertSame(
            $rawatinap->ranjang->kamar->ruangan_id,
            $rawatinap->ruangan_id
        );
    }

    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertInstanceof(Fasilitas\Ruangan::class, $rawatinap->ruangan);
    }

    /** @test */
    public function a_rawatinap_have_virtual_kelas()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertSame(
            $rawatinap->ranjang->kamar->ruangan->kelas,
            $rawatinap->kelas
        );
    }

    /** @test */
    public function a_rawatinap_have_virtual_poliklinik_id()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertSame(
            $rawatinap->ranjang->kamar->ruangan->poliklinik_id,
            $rawatinap->poliklinik_id
        );
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $rawatinap = factory(RawatInap::class)->create();

        $rawatinap = RawatInap::find($rawatinap->id);

        $this->assertInstanceof(Fasilitas\Poliklinik::class, $rawatinap->poliklinik);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource = factory(RawatInap::class)->create();

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }
}
