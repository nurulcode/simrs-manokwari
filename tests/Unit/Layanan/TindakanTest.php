<?php

namespace Tests\Unit\Layanan;

use App\Enums;
use Tests\TestCase;
use App\Models\Layanan\Tindakan;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Perawatan\RawatInap;
use App\Models\Master\TindakanPemeriksaan;

class TindakanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Tindakan::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_tindakan_pemeriksaan()
    {
        $resource = factory(Tindakan::class)->create();

        $this->assertInstanceOf(TindakanPemeriksaan::class, $resource->tindakan_pemeriksaan);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Tindakan::class)->create([
            'perawatan_type' => RawatInap::class
        ]);

        $this->assertInstanceOf(RawatInap::class, $resource->perawatan);
    }

    /** @test */
    public function it_copy_the_tarif_attribute_from_master_tindakan_pemeriksaan()
    {
        $perawatan = factory(RawatInap::class)->create();

        $master    = factory(TindakanPemeriksaan::class)->create();

        $perawatan = RawatInap::find($perawatan->id);

        $master->tarif()->create([
            'tarif' => [
                $perawatan->kelas => [
                    Enums\JenisTarif::SARANA    => 15000,
                    Enums\JenisTarif::PELAYANAN => 10000,
                    Enums\JenisTarif::BHP       => 0
                ],
            ]
        ]);

        $resource = factory(Tindakan::class)->create([
            'perawatan_type'          => RawatInap::class,
            'perawatan_id'            => $perawatan->id,
            'tindakan_pemeriksaan_id' => $master->id,
        ]);

        $master = TindakanPemeriksaan::find($master->id);

        $this->assertSame(
            $master->getTarifByKelas($perawatan->kelas),
            $resource->tarif
        );
    }
}
