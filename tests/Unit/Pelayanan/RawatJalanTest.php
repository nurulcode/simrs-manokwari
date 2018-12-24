<?php

namespace Tests\Unit\Pelayanan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Pelayanan\Pelayanan;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Pelayanan\RawatJalan;

class RawatJalanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_pasien()
    {
        $resource = factory(RawatJalan::class)->create();

        $this->assertInstanceof(Poliklinik::class, $resource->poliklinik);
    }

    /** @test */
    public function resource_belongs_to_pelayanan()
    {
        $resource  = factory(RawatJalan::class)->create();

        $kunjungan = factory(Kunjungan::class)->create();

        $kunjungan->pelayanans()->create([
            'layanan_id'   => $resource->id,
            'layanan_type' => get_class($resource)
        ]);

        $this->assertInstanceof(Pelayanan::class, $resource->pelayanan);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource  = factory(RawatJalan::class)->create();

        $kunjungan = factory(Kunjungan::class)->create();

        $kunjungan->pelayanans()->create([
            'layanan_id'   => $resource->id,
            'layanan_type' => get_class($resource)
        ]);

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }
}
