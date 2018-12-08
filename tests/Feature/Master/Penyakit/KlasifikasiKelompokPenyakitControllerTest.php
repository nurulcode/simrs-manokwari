<?php

namespace Tests\Feature\Master\Penyakit;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

class KlasifikasiKelompokPenyakitControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $klasifikasi = factory(KlasifikasiPenyakit::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Master\Penyakit\KlasifikasiKelompokPenyakitController', $klasifikasi->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $klasifikasi = factory(KlasifikasiPenyakit::class)->create();
        $kelompok    = factory(KelompokPenyakit::class, 5)->create([
            'klasifikasi_id' => $klasifikasi->id
        ]);

        $lainnya     = factory(KelompokPenyakit::class, 5)->create();

        $this->signIn()
             ->getJson(action('Master\Penyakit\KlasifikasiKelompokPenyakitController', $klasifikasi->id))
             ->assertSee($kelompok->random()->uraian)
             ->assertDontSee($lainnya->random()->uraian)
             ->assertJsonStructure(['data'  => ['*' => ['uraian']]])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
