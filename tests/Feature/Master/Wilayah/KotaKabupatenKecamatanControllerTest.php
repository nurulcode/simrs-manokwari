<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\KotaKabupaten;

class KotaKabupatenKecamatanControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $kotakab = factory(KotaKabupaten::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Master\Wilayah\KotaKabupatenKecamatanController', $kotakab->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $kotakab   = factory(KotaKabupaten::class)->create();
        $kecamatan = factory(Kecamatan::class, 5)->create(['kota_kabupaten_id' => $kotakab->id]);
        $lainnya   = factory(Kecamatan::class, 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\KotaKabupatenKecamatanController', $kotakab->id))
             ->assertJsonStructure(['data'  => ['*' => ['name', 'kota_kabupaten_name']]])
             ->assertJsonCount(5, 'data')
             ->assertSee($kecamatan->random()->name)
             ->assertDontSee($lainnya->random()->name)
             ->assertStatus(200);
    }
}
