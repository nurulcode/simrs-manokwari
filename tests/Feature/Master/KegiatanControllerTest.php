<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use App\Models\Master\Kegiatan;
use App\Models\Master\KategoriKegiatan;
use Sty\Tests\ResourceControllerTestCase;

class KegiatanControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Kegiatan::class;
    }

    /** @test */
    public function user_can_assign_new_kegiatan_to_many_kategori()
    {
        $collection = factory(KategoriKegiatan::class, 5)->create();

        $resource   = factory(Kegiatan::class)->make([
            'kategori' => $collection->map(function ($kategori, $key) {
                return ['id' => $kategori->id, 'kode' => str_random(5)];
            })->toArray()
        ]);

        $this->withExceptionHandling()
             ->signIn()
             ->postJson($resource->path('store'), $resource->toArray())
             ->assertJson(['status' => 'success'])
             ->assertStatus(201);

        $this->assertDatabaseHas('kegiatans', $resource->only('uraian'), 'master');

        $kode = array_only(array_random($resource->kategori), 'kode');

        $this->assertDatabaseHas('kategori_kegiatan_kegiatan', $kode, 'master');

        return $this;
    }
}
