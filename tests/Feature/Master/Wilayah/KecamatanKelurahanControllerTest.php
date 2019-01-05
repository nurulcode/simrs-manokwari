<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;

class KecamatanKelurahanControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $kecamatan = factory(Kecamatan::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Master\Wilayah\KecamatanKelurahanController', $kecamatan->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $kecamatan = factory(Kecamatan::class)->create();
        $kelurahan = factory(Kelurahan::class, 5)->create(['kecamatan_id' => $kecamatan->id]);
        $lainnya   = factory(Kelurahan::class, 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\KecamatanKelurahanController', $kecamatan->id))
             ->assertJsonStructure(['data'  => ['*' => ['name']]])
             ->assertJsonCount(5, 'data')
             ->assertSee($kelurahan->random()->name)
             ->assertDontSee($lainnya->random()->name)
             ->assertStatus(200);
    }
}
