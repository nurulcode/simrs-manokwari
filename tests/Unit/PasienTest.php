<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pasien;
use App\Models\Master;

class PasienTest extends TestCase
{
    /** @test */
    public function model_can_auto_generate_no_rekam_medis()
    {
        $pasien = factory(Pasien::class)->create(['no_rekam_medis' => null]);

        $this->assertEquals(str_pad($pasien->id, 8, 0, STR_PAD_LEFT), $pasien->no_rekam_medis);
    }

    /** @test */
    public function a_pasien_belongs_to_jenis_identitas()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\JenisIdentitas::class, $pasien->jenis_identitas);
    }

    /** @test */
    public function a_pasien_belongs_to_agama()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Agama::class, $pasien->agama);
    }

    /** @test */
    public function a_pasien_belongs_to_suku()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Suku::class, $pasien->suku);
    }

    /** @test */
    public function a_pasien_belongs_to_pendidikan()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Pendidikan::class, $pasien->pendidikan);
    }

    /** @test */
    public function a_pasien_belongs_to_pekerjaan()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Pekerjaan::class, $pasien->pekerjaan);
    }

    /** @test */
    public function a_pasien_belongs_to_kelurahan()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Wilayah\Kelurahan::class, $pasien->kelurahan);
    }
}
