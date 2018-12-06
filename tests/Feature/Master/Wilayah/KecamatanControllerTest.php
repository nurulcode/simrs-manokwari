<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Master\Wilayah\KotaKabupaten;

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
    public function resource_collection_can_be_filtered_by_kota_kabupaten()
    {
        $kota_kabupaten   = factory(KotaKabupaten::class)->create();

        factory($this->resource(), 5)->create(['kota_kabupaten_id' => $kota_kabupaten->id]);
        factory($this->resource(), 10)->create();

        $filter     = '?limit=10&kota_kabupaten=' . $kota_kabupaten->id;

        $this->signIn()
             ->getJson(action('Master\Wilayah\KecamatanController@index') . $filter)
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
    public function resource_has_kota_kabupaten_in_collection_structure()
    {
        factory($this->resource(), 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\KecamatanController@index'))
             ->assertJson([
                'data'  => [],
             ])
             ->assertJsonStructure([
                'data'  => ['*' => ['kota_kabupaten', 'kota_kabupaten_name']],
             ]);
    }
}
