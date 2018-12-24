<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\Master\Penyakit\Penyakit;

class KunjunganTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_pasien()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->assertInstanceof(Pasien::class, $kunjungan->pasien);
    }

    /** @test */
    public function resource_belongs_to_penyakit()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->assertInstanceof(Penyakit::class, $kunjungan->penyakit);
    }

    /** @test */
    public function model_can_auto_generate_nomor_kunjungan()
    {
        $kunjungan = factory(Kunjungan::class)->create(['nomor_kunjungan' => null]);

        $this->assertEquals(str_pad($kunjungan->id, 8, 0, STR_PAD_LEFT), $kunjungan->nomor_kunjungan);
    }
}
