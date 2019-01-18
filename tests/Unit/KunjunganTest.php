<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\Perawatan;
use Illuminate\Support\Collection;
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
    public function resource_may_has_many_rawat_jalan()
    {
        $kunjungan     = factory(Kunjungan::class)->create();

        $rawat_jalans = factory(Perawatan\RawatJalan::class, 5)->create([
            'kunjungan_id' => $kunjungan->id
        ]);

        $this->assertInstanceOf(Collection::class, $kunjungan->rawat_jalans);
        $this->assertInstanceOf(Perawatan\RawatJalan::class, $kunjungan->rawat_jalans->random());
    }

    /** @test */
    public function resource_may_has_many_rawat_darurat()
    {
        $kunjungan      = factory(Kunjungan::class)->create();

        $rawat_darurats = factory(Perawatan\RawatDarurat::class, 5)->create([
            'kunjungan_id' => $kunjungan->id
        ]);

        $this->assertInstanceOf(Collection::class, $kunjungan->rawat_darurats);
        $this->assertInstanceOf(Perawatan\RawatDarurat::class, $kunjungan->rawat_darurats->random());
    }

    /** @test */
    public function resource_may_has_many_rawat_inap()
    {
        $kunjungan   = factory(Kunjungan::class)->create();

        $rawat_inaps = factory(Perawatan\RawatInap::class, 5)->create([
            'kunjungan_id' => $kunjungan->id
        ]);

        $this->assertInstanceOf(Collection::class, $kunjungan->rawat_inaps);
        $this->assertInstanceOf(Perawatan\RawatInap::class, $kunjungan->rawat_inaps->random());
    }

    /** @test */
    public function model_can_auto_generate_nomor_kunjungan()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->assertEquals(str_pad($kunjungan->id, 8, 0, STR_PAD_LEFT), $kunjungan->nomor_kunjungan);
    }
}
