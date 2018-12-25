<?php

namespace Tests\Unit\Perawatan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Perawatan\Perawatan;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Perawatan\RawatJalan;

class RawatJalanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = factory(RawatJalan::class)->create();

        $this->assertInstanceof(Poliklinik::class, $resource->poliklinik);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource  = factory(RawatJalan::class)->create();

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource  = factory(RawatJalan::class)->create();

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
        $resource  = factory(RawatJalan::class)->create();

        $this->assertDatabaseHas('perawatans', [
            'kunjungan_id'   => $resource->kunjungan_id,
            'perawatan_id'   => $resource->id,
            'perawatan_type' => get_class($resource),
        ]);
    }

    // /** @test */
    // public function resource_has_many_diagnosa()
    // {
    //     $resource = factory(RawatJalan::class)->create();

    //     $this->assertInstanceof(Poliklinik::class, $resource->poliklinik);
    // }
}
