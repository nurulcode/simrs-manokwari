<?php

namespace Tests\Feature\Layanan;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Layanan\Diagnosa;
use App\Models\Perawatan\RawatJalan;

class DiagnosaRawatJalanControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function user_can_see_resource_collection()
    {
        $rawat    = factory(RawatJalan::class)->create();

        factory(Diagnosa::class, 10)->create([
            'perawatan_type' => RawatJalan::class,
            'perawatan_id'   => $rawat->id,
        ]);

        $this->signIn()
             ->getJson(action('Perawatan\RawatJalanDiagnosaController@index', $rawat->id))
             ->assertJson(['data' => []])
             ->assertJsonStructure([
                'data'  => ['*' => ['path']]
              ])
             ->assertJsonCount(10, 'data')
             ->assertStatus(200);

        return $this;
    }

    /** @test **/
    public function user_can_create_a_resource()
    {
        $rawat    = factory(RawatJalan::class)->create();

        $resource = factory(Diagnosa::class)->make();

        $this->signIn()
            ->postJson(
                action('Perawatan\RawatJalanDiagnosaController@store', $rawat->id),
                array_except($resource->toArray(), ['perawatan_id', 'perawatan_type']))
            ->assertJson(['status' => 'success'])
            ->assertHeader('Location')
            ->assertStatus(201);

        $this->assertDatabaseHas(
            $resource->getTable(),
            array_except($resource->getAttributes(), ['perawatan_id', 'perawatan_type'])
        );
    }
}
