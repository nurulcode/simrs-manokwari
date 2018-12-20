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
}
