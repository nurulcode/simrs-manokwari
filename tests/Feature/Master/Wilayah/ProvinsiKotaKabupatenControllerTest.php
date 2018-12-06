<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Master\Wilayah\Provinsi;
use App\Models\Master\Wilayah\KotaKabupaten;

class ProvinsiKotaKabupatenControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $provinsi = factory(Provinsi::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Master\Wilayah\ProvinsiKotaKabupatenController', $provinsi->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $provinsi  = factory(Provinsi::class)->create();
        $kotakabs  = factory(KotaKabupaten::class, 5)->create(['provinsi_id' => $provinsi->id]);
        $kotalain  = factory(KotaKabupaten::class, 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\ProvinsiKotaKabupatenController', $provinsi->id))
             ->assertJsonStructure(['data'  => ['*' => ['name', 'provinsi']]])
             ->assertJsonCount(5, 'data')
             ->assertSee($kotakabs->random()->name)
             ->assertDontSee($kotalain->random()->name)
             ->assertStatus(200);
    }
}
