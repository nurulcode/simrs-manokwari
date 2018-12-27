<?php

namespace Tests\Feature\Perawatan;

use Tests\TestCase;
use App\Models\Kunjungan;
use Sty\Tests\ResourceControllerTestCase;

class RawatDaruratControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Perawatan\RawatDarurat::class;
    }

    public function matchDatabase($resource)
    {
        return array_except($resource->getAttributes(), 'kunjungan_id');
    }

    /** @test **/
    public function user_can_create_a_resource()
    {
        $kunjungan = factory(Kunjungan::class)->make();

        $resource  = factory($this->resource())->make([
            'kunjungan_id' => $kunjungan->id
        ]);

        $this->signIn()
            ->postJson($resource->path('store'), array_merge(
                $kunjungan->toArray(),
                $resource->toArray()
            ))
            ->assertJson(['status' => 'success'])
            ->assertHeader('Location')
            ->assertStatus(201);

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($resource)
        );

        $this->assertDatabaseHas(
            $kunjungan->getTable(),
            $kunjungan->getAttributes()
        );
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $kunjungan = factory(Kunjungan::class)->make([
            'jenis_registrasi_id' => str_random(9),
            'pasien_id'           => str_random(9),
            'kasus_id'            => str_random(9),
            'penyakit_id'         => str_random(9),
            'jenis_rujukan_id'    => str_random(9),
            'cara_pembayaran_id'  => str_random(9),
        ]);
        $resource  = factory($this->resource())->make([
            'kegiatan_id'         => str_random(9),
            'poliklinik_id'       => str_random(9),
        ]);

        $this->signIn()
            ->postJson($resource->path('store'), array_merge(
                $resource->toArray(),
                $kunjungan->toArray()
            ))
            ->assertJson(['errors' => []])
            ->assertJsonValidationErrors([
                'jenis_registrasi_id',
                'pasien_id',
                'kasus_id',
                'penyakit_id',
                'rujukan.jenis_id',
                'cara_pembayaran_id',
                'kegiatan_id',
                'poliklinik_id',
            ])
            ->assertStatus(422);
    }

    /** @test **/
    public function user_can_update_a_resource()
    {
        $this->assertTrue(true);
    }

    /** @test **/
    public function user_can_delete_a_resource()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function user_can_not_put_empty_data_to_a_resource()
    {
        $this->assertTrue(true);
    }
}
