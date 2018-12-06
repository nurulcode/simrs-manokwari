<?php

namespace Tests\Unit\Master\Wilayah;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;
use App\Models\Master\Wilayah\KotaKabupaten;

class KecamatanTest extends TestCase
{
    /** @test */
    public function a_kotakab_belongs_to_provinsi()
    {
        $kecamatan = factory(Kecamatan::class)->create();

        $this->assertInstanceof(KotaKabupaten::class, $kecamatan->kota_kabupaten);
    }

    /** @test */
    public function a_kecamatan_may_has_many_kelurahan()
    {
        $kecamatan = factory(Kecamatan::class)->create();

        factory(Kelurahan::class, 10)->create([
            'kecamatan_id' => $kecamatan->id
        ]);

        $this->assertInstanceOf(Collection::class, $kecamatan->kelurahans);
        $this->assertInstanceOf(Kelurahan::class, $kecamatan->kelurahans->random());
    }
}
