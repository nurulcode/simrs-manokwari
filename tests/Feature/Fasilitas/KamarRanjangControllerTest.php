<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ranjang;

class KamarRanjangControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $kamar = factory(Kamar::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Fasilitas\KamarRanjangController', $kamar->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $kamar = factory(Kamar::class)->create();

        factory(Ranjang::class, 5)->create([
            'kamar_id' => $kamar->id
        ]);

        factory(Ranjang::class, 5)->create();

        $this->signIn()
             ->getJson(action('Fasilitas\KamarRanjangController', $kamar->id))
             ->assertSee($kamar->nama)
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
