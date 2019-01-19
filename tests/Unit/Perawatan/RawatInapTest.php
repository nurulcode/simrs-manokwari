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
    public function a_resource_belong_to_latest_layanan_kamar()
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

        $this->assertInstanceOf(Kamar::class, $resource->kamar);

        $this->assertEquals($resource->kamar->id, $kamar->id);
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
}
