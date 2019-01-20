<?php

namespace Tests\Unit\Perawatan;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Fasilitas;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use App\Models\Layanan\Kamar;
use App\Models\Master\Kegiatan;
use Illuminate\Support\Collection;
use App\Models\Perawatan\RawatInap;

class RawatInapTest extends TestCase
{
    public function createResourceWithKamar()
    {
        $resource = factory(RawatInap::class)->create();

        $ranjang  = factory(Fasilitas\Ranjang::class)->create();

        $resource->kamars()->create([
            'waktu_masuk'  => Carbon::now(),
            'waktu_keluar' => Carbon::now(),
            'ranjang_id'   => $ranjang->id,
        ]);

        $ranjang  = factory(Fasilitas\Ranjang::class)->create();

        $kamar    = factory(Kamar::class)->create([
            'ranjang_id'   => $ranjang->id,
            'perawatan_id' => $resource->id
        ]);

        return RawatInap::find($resource->id);
    }

    /** @test */
    public function resource_belongs_to_registrasi()
    {
        $resource   = factory(RawatInap::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $this->assertInstanceof(Registrasi::class, $resource->registrasi);
    }

    /** @test */
    public function resource_belongs_to_kegiatan()
    {
        $resource = factory(RawatInap::class)->create();

        $this->assertInstanceof(Kegiatan::class, $resource->kegiatan);
    }

    /** @test */
    public function a_resource_has_many_layanan_kamar()
    {
        $resource = factory(RawatInap::class)->create();

        $ranjang  = factory(Fasilitas\Ranjang::class)->create();

        $resource->kamars()->create([
            'waktu_masuk' => Carbon::now(),
            'ranjang_id'  => $ranjang->id,
        ]);

        $this->assertInstanceOf(Collection::class, $resource->kamars);

        $this->assertInstanceOf(Kamar::class, $resource->kamars->random());
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource   = factory(RawatInap::class)->create();
        $kunjungan  = factory(Kunjungan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'kunjungan_id'   => $kunjungan->id,
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $resource = RawatInap::find($resource->id);

        $this->assertEquals($resource->kunjungan->id, $kunjungan->id);

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }

    /** @test */
    public function a_resource_have_virtual_ranjang_id()
    {
        $resource = $this->createResourceWithKamar();

        $kamar    = $resource->kamars()
            ->whereNull('waktu_keluar')
            ->latest()
            ->first();

        $this->assertSame($kamar->ranjang_id, $resource->ranjang_id);
    }

    /** @test */
    public function resource_belongs_to_ranjang()
    {
        $resource = $this->createResourceWithKamar();

        $this->assertInstanceof(Fasilitas\Ranjang::class, $resource->ranjang);
    }

    /** @test */
    public function a_resource_have_virtual_kamar_id()
    {
        $resource = $this->createResourceWithKamar();

        $kamar    = $resource->kamars()
            ->whereNull('waktu_keluar')
            ->latest()
            ->first();

        $this->assertSame($kamar->kamar_id, $resource->kamar_id);
    }

    /** @test */
    public function resource_belongs_to_kamar()
    {
        $resource = $this->createResourceWithKamar();

        $this->assertInstanceof(Fasilitas\Kamar::class, $resource->kamar);
    }

    /** @test */
    public function a_resource_have_virtual_ruangan_id()
    {
        $resource = $this->createResourceWithKamar();

        $kamar    = $resource->kamars()
            ->whereNull('waktu_keluar')
            ->latest()
            ->first();

        $this->assertEquals($kamar->ruangan_id, $resource->ruangan_id);
    }

    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $resource = $this->createResourceWithKamar();

        $this->assertInstanceof(Fasilitas\Ruangan::class, $resource->ruangan);
    }

    /** @test */
    public function a_resource_have_virtual_kelas()
    {
        $resource = $this->createResourceWithKamar();

        $kamar    = $resource->kamars()
            ->whereNull('waktu_keluar')
            ->latest()
            ->first();

        $this->assertEquals($kamar->ruangan->kelas, $resource->kelas);
    }

    /** @test */
    public function a_resource_have_virtual_poliklinik_id()
    {
        $resource = $this->createResourceWithKamar();

        $kamar    = $resource->kamars()
            ->whereNull('waktu_keluar')
            ->latest()
            ->first();

        $this->assertEquals($kamar->poliklinik_id, $resource->poliklinik_id);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = $this->createResourceWithKamar();

        $this->assertInstanceof(Fasilitas\Poliklinik::class, $resource->poliklinik);
    }
}
