<?php

namespace Tests\Feature;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use Sty\Tests\ResourceViewTestCase;
use App\Models\Master\TindakanPemeriksaan;
use App\Enums\KelasTarif;
use App\Enums\JenisTarif;

class TarifControllerTest extends TestCase
{
    use APITestCase, ResourceViewTestCase;

    public function viewpath()
    {
        return url('tarif');
    }

    /** @test **/
    public function user_can_create_a_resource()
    {
        $tarifable = factory(TindakanPemeriksaan::class)->create();

        $this->signIn()
            ->postJson(action('StoreTarifController'), [
                'tarifable_type' => TindakanPemeriksaan::class,
                'tarifable_id'   => $tarifable->id,
                'data'           => [
                    KelasTarif::KELAS_VVIP => [
                        JenisTarif::SARANA    => 10000,
                        JenisTarif::PELAYANAN => 10000,
                        JenisTarif::BHP       => 10000,
                    ]
                ]
            ])
            ->assertJson(['status' => 'success'])
            ->assertStatus(200);

        $this->assertDatabaseHas('tarifs', [
            'tarifable_type' => TindakanPemeriksaan::class,
            'tarifable_id'   => $tarifable->id,
        ]);
    }
}
