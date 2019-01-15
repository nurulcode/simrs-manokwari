<?php

namespace Tests\Unit\Perawatan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Layanan\Diagnosa;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Perawatan\RawatJalan;
use App\Models\Perawatan\Registrasi;

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
    public function creating_resource_also_create_pivot_registrasis()
    {
        $resource  = factory(RawatJalan::class)->create();

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
        $resource = factory(RawatJalan::class)->create();

        $this->assertInstanceof(Registrasi::class, $resource->registrasi);
    }

    /** @test */
    public function resource_has_many_diagnosa()
    {
        $resource = factory(RawatJalan::class)->create();

        factory(Diagnosa::class, 5)->create([
            'perawatan_type' => RawatJalan::class,
            'perawatan_id'   => $resource->id,
        ]);

        $this->assertInstanceof(Diagnosa::class, $resource->diagnosa->random());
    }
}
