<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use App\Models\Master\Wilayah\Provinsi;
use Sty\Tests\ResourceControllerTestCase;

class KotaKabupatenControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Wilayah\KotaKabupaten::class;
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path, ['provinsi_id' => str_random(5)])
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['provinsi_id'])
             ->assertStatus(422);
    }

    /** @test */
    public function resource_has_provinsi_in_collection_structure()
    {
        factory($this->resource(), 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\KotaKabupatenController@index'))
             ->assertJson([
                'data'  => [],
             ])
             ->assertJsonStructure([
                'data'  => ['*' => ['provinsi', 'provinsi_name']],
             ]);
    }
}
