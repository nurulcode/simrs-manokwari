<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kunjungan;
use Sty\Tests\APITestCase;

class RawatJalanControllerTest extends TestCase
{
    use APITestCase;

    public function resource()
    {
        return \App\Models\RawatJalan::class;
    }

    /** @test **/
    public function user_can_create_a_resource()
    {
        $kunjungan = factory(Kunjungan::class)->make();
        $resource  = factory($this->resource())->make();

        $this->signIn()
            ->postJson($resource->path('store'), array_merge(
                $resource->toArray(),
                $kunjungan->toArray()
            ))
            ->assertJson(['status' => 'success'])
            ->assertHeader('Location')
            ->assertStatus(201);

        $this->assertDatabaseHas(
            $resource->getTable(),
            $resource->getAttributes()
        );

        $this->assertDatabaseHas(
            $kunjungan->getTable(),
            $kunjungan->getAttributes()
        );

        $this->assertDatabaseHas('pelayanans', [
            'kunjungan_id' => '1',
            'layanan_id'   => '1',
            'layanan_type' => get_class($resource)
        ]);
    }
}
