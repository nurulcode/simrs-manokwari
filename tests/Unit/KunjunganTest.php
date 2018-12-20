<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pasien;
use App\Models\Kunjungan;

class KunjunganTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_pasien()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->assertInstanceof(Pasien::class, $kunjungan->pasien);
    }

    /** @test */
    public function model_can_auto_generate_nomor_kunjungan()
    {
        $kunjungan = factory(Kunjungan::class)->create(['nomor_kunjungan' => null]);

        $this->assertEquals(str_pad($kunjungan->id, 8, 0, STR_PAD_LEFT), $kunjungan->nomor_kunjungan);
    }
}
