<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Master\Kegiatan;
use App\Models\Master\KategoriKegiatan;

class KegiatanKategoriKegiatanTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $kategori = factory(KategoriKegiatan::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Master\KegiatanKategoriKegiatanController', $kategori->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $kategori  = factory(KategoriKegiatan::class)->create();
        $kegiatan  = factory(Kegiatan::class, 5)->create();
        $lainnya   = factory(Kegiatan::class, 5)->create();

        $kategori->kegiatan()->attach(
            $kegiatan->pluck('id')->flip()->map(function ($value, $key) {
                return ['kode' => str_random(5)];
            })
        );

        $this->signIn()
             ->getJson(action('Master\KegiatanKategoriKegiatanController', $kategori->id))
             ->assertSee($kegiatan->random()->uraian)
             ->assertDontSee($lainnya->random()->uraian)
             ->assertJsonStructure(['data'  => ['*' => ['uraian']]])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
