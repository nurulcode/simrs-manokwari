<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class KualifikasiControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Kepegawaian\Kualifikasi::class;
    }

    /** @test **/
    public function user_cannot_create_duplicate_kode()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode
        ]);

        $this->postJson($resource->path('store'), $this->beforePut($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kode'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_update_with_same_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode
        ]);

        $this->putJson($existing->path, $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'kategori_id' => str_random(5),
            'laki_laki'   => str_random(5),
            'perempuan'   => str_random(5)
        ]);

        $this->signIn()
             ->postJson($resource->path, $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kategori_id', 'laki_laki', 'perempuan'])
             ->assertStatus(422);
    }
}
