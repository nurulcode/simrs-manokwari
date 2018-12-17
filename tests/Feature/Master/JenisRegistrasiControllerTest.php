<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class JenisRegistrasiControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\JenisRegistrasi::class;
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'kategori' => str_random(9)
        ]);

        $this->signIn()
             ->postJson($resource->path, $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kategori'])
             ->assertStatus(422);
    }
}
