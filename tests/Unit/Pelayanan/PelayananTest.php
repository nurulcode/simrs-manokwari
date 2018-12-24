<?php

namespace Tests\Unit\Pelayanan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Pelayanan\RawatJalan;

class PelayananTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource  = factory(RawatJalan::class)->create();

        $kunjungan = factory(Kunjungan::class)->create();

        $kunjungan->pelayanans()->create([
            'layanan_id'   => $resource->id,
            'layanan_type' => get_class($resource)
        ]);

        $pelayanan = $kunjungan->pelayanans->random();

        $this->assertInstanceof(Kunjungan::class, $pelayanan->kunjungan);
    }

    /** @test */
    public function resource_has_one_layanan()
    {
        $resource  = factory(RawatJalan::class)->create();

        $kunjungan = factory(Kunjungan::class)->create();

        $kunjungan->pelayanans()->create([
            'layanan_id'   => $resource->id,
            'layanan_type' => get_class($resource)
        ]);

        $pelayanan = $kunjungan->pelayanans->random();

        $this->assertInstanceof(RawatJalan::class, $pelayanan->layanan);
    }
}
