<?php

namespace Tests\Feature\Layanan;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class DiagnosaControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Layanan\Diagnosa::class;
    }

    public function matchDatabase($resource)
    {
        return array_except($resource->getAttributes(), ['perawatan_type', 'perawatan_id']);
    }

    /** @test **/
    public function user_can_create_a_resource()
    {
        $this->assertTrue(true);
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'penyakit_id'      => str_random(9),
            'tipe_diagnosa_id' => str_random(9),
            'petugas_id'       => str_random(9),
            'kasus'            => str_random(9),
        ]);

        $this->signIn()
            ->postJson($resource->path, $this->beforePost($resource))
            ->assertJson(['errors' => []])
            ->assertJsonValidationErrors([
                'penyakit_id',
                'tipe_diagnosa_id',
                'petugas_id',
                'kasus',
            ])
            ->assertStatus(422);
    }
}
