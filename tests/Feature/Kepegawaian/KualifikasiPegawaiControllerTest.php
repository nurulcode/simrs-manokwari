<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Kualifikasi;

class KualifikasiPegawaiControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $kualifikasi = factory(Kualifikasi::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Kepegawaian\KualifikasiPegawaiController', $kualifikasi->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $kualifikasi = factory(Kualifikasi::class)->create();
        $pegawai     = factory(Pegawai::class, 5)->create([
            'kualifikasi_id' => $kualifikasi->id
        ]);

        $lainnya = factory(Pegawai::class, 5)->create();

        $this->signIn()
             ->getJson(action('Kepegawaian\KualifikasiPegawaiController', $kualifikasi->id))
             ->assertJson(['data' => []])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
