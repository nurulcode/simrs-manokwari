<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Pegawai;

class JabatanPegawaiControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $jabatan = factory(Jabatan::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Kepegawaian\JabatanPegawaiController', $jabatan->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $jabatan = factory(Jabatan::class)->create();
        $pegawai = factory(Pegawai::class, 5)->create([
            'jabatan_id' => $jabatan->id
        ]);

        $lainnya = factory(Pegawai::class, 5)->create();

        $this->signIn()
             ->getJson(action('Kepegawaian\JabatanPegawaiController', $jabatan->id))
             ->assertJson(['data' => []])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
