<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Kepegawaian\Kualifikasi;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KategoriKualifikasiKualifikasiControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $kategori = factory(KategoriKualifikasi::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Kepegawaian\KategoriKualifikasiKualifikasiController', $kategori->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $kategori = factory(KategoriKualifikasi::class)->create();

        factory(Kualifikasi::class, 5)->create([
            'kategori_id' => $kategori->id
        ]);

        $lainnya = factory(Kualifikasi::class, 5)->create();

        $this->signIn()
             ->getJson(action('Kepegawaian\KategoriKualifikasiKualifikasiController', $kategori->id))
             ->assertJson(['data' => []])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
