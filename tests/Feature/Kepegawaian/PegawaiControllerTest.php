<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class PegawaiControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Kepegawaian\Pegawai::class;
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'kualifikasi_id' => str_random(5),
            'jabatan_id'     => str_random(5),
            'jenis_kelamin'  => str_random(5),
            'tanggal_lahir'  => str_random(5),
        ]);

        $this->signIn()
            ->postJson($resource->path, $this->beforePost($resource))
            ->assertJson(['errors' => []])
            ->assertJsonValidationErrors([
                'kualifikasi_id',
                'jabatan_id',
                'jenis_kelamin',
                'tanggal_lahir'
            ])
            ->assertStatus(422);
    }
}
