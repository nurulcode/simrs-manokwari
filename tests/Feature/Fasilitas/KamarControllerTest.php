<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class KamarControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Fasilitas\Kamar::class;
    }

    public function beforePost($resource)
    {
        return array_merge($resource->toArray(), [
            'poliklinik_id' => $resource->ruangan->poliklinik_id,
        ]);
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'poliklinik_id' => str_random(9),
            'ruangan_id'    => str_random(9),
        ]);

        $this->signIn()
             ->postJson($resource->path, $resource->toArray())
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['ruangan_id', 'poliklinik_id'])
             ->assertStatus(422);
    }
}
