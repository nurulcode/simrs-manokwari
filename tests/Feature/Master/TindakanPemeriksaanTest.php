<?php

namespace Tests\Feature\Master;

use App\Enums;
use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Master\TindakanPemeriksaan;

class TindakanPemeriksaanTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Master\TindakanPemeriksaan::class;
    }

    public function viewpath()
    {
        return url('master/tindakan');
    }

    /** @test **/
    public function user_cannot_create_duplicate_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode
        ]);

        $this->postJson($resource->path('store'), $this->beforePost($resource))
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

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'parent_id' => str_random(9),
            'jenis'     => str_random(9)
        ]);

        $this->signIn()
             ->postJson($resource->path, $resource->toArray())
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['parent_id', 'jenis'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_create_a_resource_with_parent()
    {
        $parent   = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'parent_id' => $parent->id
        ]);

        $this->signIn()
             ->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertHeader('Location')
             ->assertStatus(201);

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($resource),
            $this->getDatabaseConnection($resource)
        );

        $this->assertDatabaseHas(
            $this->resourceTable($parent),
            $this->matchDatabase($parent),
            $this->getDatabaseConnection($parent)
        );
    }

    /** @test **/
    public function user_can_set_tarif_for_resource()
    {
        $tarifable = factory(TindakanPemeriksaan::class)->create();

        $tarif = [
            Enums\KelasTarif::KELAS_VVIP => [
                Enums\JenisTarif::SARANA    => 10000,
                Enums\JenisTarif::PELAYANAN => 10000,
                Enums\JenisTarif::BHP       => 10000,
            ]
        ];

        $this->signIn()
            ->postJson(action('StoreTarifController'), [
                'tarif'          => $tarif,
                'tarifable_type' => TindakanPemeriksaan::class,
                'tarifable_id'   => $tarifable->id,
            ])
            ->assertJson(['status' => 'success'])
            ->assertStatus(200);

        $tarifable = TindakanPemeriksaan::find($tarifable->id);

        $this->assertDatabaseHas('tarifs', [
            'tarifable_type' => TindakanPemeriksaan::class,
            'tarifable_id'   => $tarifable->id,
        ]);

        $this->assertArrayHasKey(Enums\KelasTarif::KELAS_VVIP, $tarifable->tarif);

        $this->assertCount(
            count(array_unique(Enums\KelasTarif::getValues())), $tarifable->tarif
        );

        $this->assertArraySubset($tarif, $tarifable->tarif);
    }
}
