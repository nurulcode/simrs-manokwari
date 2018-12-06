<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use App\Models\Master\Wilayah\Kecamatan;
use Sty\Tests\ResourceControllerTestCase;

class KelurahanControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Wilayah\Kelurahan::class;
    }

    public function beforePost($resource)
    {
        return array_merge($resource->toArray(), [
            'kota_kabupaten_id' => $resource->kecamatan->kota_kabupaten_id,
            'provinsi_id'       => $resource->kecamatan->kota_kabupaten->provinsi_id,
        ]);
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path, [
                'provinsi_id'       => str_random(5),
                'kota_kabupaten_id' => str_random(5),
                'kecamatan_id'      => str_random(5),
            ])
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kota_kabupaten_id', 'provinsi_id', 'kecamatan_id'])
             ->assertStatus(422);
    }

    /** @test */
    public function resource_collection_can_be_filtered_by_kecamatan()
    {
        $kecamatan   = factory(Kecamatan::class)->create();

        factory($this->resource(), 5)->create(['kecamatan_id' => $kecamatan->id]);
        factory($this->resource(), 10)->create();

        $filter     = '?limit=10&kecamatan=' . $kecamatan->id;

        $this->signIn()
             ->getJson(action('Master\Wilayah\KelurahanController@index') . $filter)
             ->assertJson([
                'data'  => [],
                'links' => [],
                'meta'  => [],
             ])
             ->assertJsonStructure([
                'data'  => ['*' => ['path']],
                'links' => [],
                'meta'  => []
              ])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);

        return $this;
    }

    /** @test */
    public function resource_has_kecamatan_in_collection_structure()
    {
        factory($this->resource(), 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\KelurahanController@index'))
             ->assertJson([
                'data'  => [],
             ])
             ->assertJsonStructure([
                'data'  => ['*' => ['kecamatan', 'kecamatan_name']],
             ]);
    }
}
