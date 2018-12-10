<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ruangan;

class RuanganKamarControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $ruangan = factory(Ruangan::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Fasilitas\RuanganKamarController', $ruangan->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $ruangan = factory(Ruangan::class)->create();
        $kamar   = factory(Kamar::class, 5)->create([
            'ruangan_id' => $ruangan->id
        ]);

        $lainnya     = factory(Ruangan::class, 5)->create();

        $this->signIn()
            ->getJson(action('Fasilitas\RuanganKamarController', $ruangan->id))
             ->assertJsonStructure(['data'  => ['*' => ['nama']]])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
