<?php

namespace Tests\Unit\Perawatan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Layanan\Diagnosa;
use App\Models\Perawatan\Perawatan;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Perawatan\RawatDarurat;

class RawatDaruratTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = factory(RawatDarurat::class)->create();

        $this->assertInstanceof(Poliklinik::class, $resource->poliklinik);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource  = factory(RawatDarurat::class)->create();

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource  = factory(RawatDarurat::class)->create();

        $perawatan = Perawatan::create([
            'kunjungan_id'   => $resource->kunjungan_id,
            'perawatan_id'   => $resource->id,
            'perawatan_type' => get_class($resource)
        ]);

        $this->assertInstanceof(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function creating_resource_also_create_pivot_perawatans()
    {
        $resource  = factory(RawatDarurat::class)->create();

        $this->assertDatabaseHas('perawatans', [
            'kunjungan_id'   => $resource->kunjungan_id,
            'perawatan_id'   => $resource->id,
            'perawatan_type' => get_class($resource),
        ]);
    }

    /** @test */
    public function resource_has_many_diagnosa()
    {
        $resource = factory(RawatDarurat::class)->create();

        factory(Diagnosa::class, 5)->create([
            'perawatan_type' => RawatDarurat::class,
            'perawatan_id'   => $resource->id,
        ]);

        $this->assertInstanceof(Diagnosa::class, $resource->diagnosa->random());
    }
}
