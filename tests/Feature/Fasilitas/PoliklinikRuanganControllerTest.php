<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Fasilitas\Ruangan;
use App\Models\Fasilitas\Poliklinik;

class PoliklinikRuanganControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $poliklinik = factory(Poliklinik::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Fasilitas\PoliklinikRuanganController', $poliklinik->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $poliklinik = factory(Poliklinik::class)->create();
        $ruangan    = factory(Ruangan::class, 5)->create([
            'poliklinik_id' => $poliklinik->id
        ]);

        $lainnya     = factory(Ruangan::class, 5)->create();

        $this->signIn()
            ->getJson(action('Fasilitas\PoliklinikRuanganController', $poliklinik->id))
             ->assertJsonStructure(['data'  => ['*' => ['nama']]])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
