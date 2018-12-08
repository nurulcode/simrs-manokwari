<?php

namespace Tests\Feature\Master\Penyakit;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Master\Penyakit\Penyakit;
use App\Models\Master\Penyakit\KelompokPenyakit;

class KelompokPenyakitPenyakitControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function resource_not_accessible_by_guest()
    {
        $kelompok = factory(KelompokPenyakit::class)->create();

        $this->withExceptionHandling()
            ->getJson(action('Master\Penyakit\KelompokPenyakitPenyakitController', $kelompok->id))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_resource_collection_data()
    {
        $kelompok = factory(KelompokPenyakit::class)->create();
        $penyakit = factory(Penyakit::class, 5)->create([
            'kelompok_id' => $kelompok->id
        ]);

        $lainnya     = factory(Penyakit::class, 5)->create();

        $this->signIn()
             ->getJson(action('Master\Penyakit\KelompokPenyakitPenyakitController', $kelompok->id))
             ->assertSee($penyakit->random()->uraian)
             ->assertDontSee($lainnya->random()->uraian)
             ->assertJsonStructure(['data'  => ['*' => ['uraian']]])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
