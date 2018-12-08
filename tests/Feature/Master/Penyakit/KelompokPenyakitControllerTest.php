<?php

namespace Tests\Feature\Master\Penyakit;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class KelompokPenyakitControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Penyakit\KelompokPenyakit::class;
    }

    /** @test **/
    public function user_cannot_create_with_invalid_data()
    {
        $this->signIn();

        $resource = factory($this->resource())->make([
            'klasifikasi_id' => str_random(99),
        ]);

        $this->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['klasifikasi_id'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_cannot_create_duplicate_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode,
            'icd'  => $existing->icd,
        ]);

        $this->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kode', 'icd'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_update_with_same_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode,
            'icd'  => $existing->icd,
        ]);

        $this->putJson($existing->path, $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);
    }
}
