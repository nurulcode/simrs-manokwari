<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class KecamatanControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Wilayah\Kecamatan::class;
    }

    public function beforePost($resource)
    {
        return array_merge($resource->toArray(), [
            'provinsi_id' => $resource->kota_kabupaten->provinsi_id,
        ]);
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path, [
                'provinsi_id'       => str_random(5),
                'kota_kabupaten_id' => str_random(5)
            ])
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kota_kabupaten_id', 'provinsi_id'])
             ->assertStatus(422);
    }

    /** @test */
    public function resource_has_kota_kabupaten_in_collection_structure()
    {
        factory($this->resource(), 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\KecamatanController@index'))
             ->assertJson([
                'data'  => [],
             ])
             ->assertJsonStructure([
                'data'  => ['*' => ['kota_kabupaten']],
             ]);
    }
}
