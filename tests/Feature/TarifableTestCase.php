<?php

namespace Tests\Feature;

use App\Enums\JenisTarif;
use App\Enums\KelasTarif;

trait TarifableTestCase
{
    /** @test **/
    public function user_can_set_tarif_for_resource()
    {
        $tarifable = factory($this->resource())->create();

        $kelas     = KelasTarif::getRandomValue();

        $tarif = [
            $kelas => [
                JenisTarif::SARANA    => 10000,
                JenisTarif::PELAYANAN => 10000,
                JenisTarif::BHP       => 10000,
            ]
        ];

        $this->signIn()
            ->postJson(action('StoreTarifController'), [
                'tarif'          => $tarif,
                'tarifable_type' => $this->resource(),
                'tarifable_id'   => $tarifable->id,
            ])
            ->assertJson(['status' => 'success'])
            ->assertStatus(200);

        $tarifable = call_user_func([$this->resource(), 'find'], $tarifable->id);

        $this->assertDatabaseHas('tarifs', [
            'tarifable_type' => $this->resource(),
            'tarifable_id'   => $tarifable->id,
        ]);

        $this->assertArrayHasKey($kelas, $tarifable->tarif);

        $this->assertCount(
            count(array_unique(KelasTarif::getValues())), $tarifable->tarif
        );

        $this->assertArraySubset($tarif, $tarifable->tarif);
    }

    /** @test */
    public function user_can_update_subset_of_tarif()
    {
        $kelas_tarif   = array_unique(KelasTarif::getValues());

        $tarifable     = factory($this->resource())->create();

        [$kelas_pertama, $kelas_kedua] = array_random($kelas_tarif, 2);

        $tarif = [
            $kelas_pertama => [
                JenisTarif::SARANA    => 10000,
                JenisTarif::PELAYANAN => 10000,
                JenisTarif::BHP       => 10000,
            ]
        ];

        $tarifable->tarif()->create(compact('tarif'));

        $tarif_baru = [
            $kelas_kedua => [
                JenisTarif::SARANA    => 15000,
                JenisTarif::PELAYANAN => 15000,
                JenisTarif::BHP       => 15000,
            ]
        ];

        $this->signIn()
            ->postJson(action('StoreTarifController'), [
                'tarif'          => $tarif_baru,
                'tarifable_type' => $this->resource(),
                'tarifable_id'   => $tarifable->id,
            ])
            ->assertJson(['status' => 'success'])
            ->assertStatus(200);

        $tarifable = call_user_func([$this->resource(), 'find'], $tarifable->id);

        $this->assertDatabaseHas('tarifs', [
            'tarifable_type' => $this->resource(),
            'tarifable_id'   => $tarifable->id,
        ]);

        $this->assertArrayHasKey($kelas_pertama, $tarifable->tarif);
        $this->assertArrayHasKey($kelas_kedua, $tarifable->tarif);

        $this->assertCount(
            count(array_unique(KelasTarif::getValues())), $tarifable->tarif
        );

        $this->assertArraySubset($tarif, $tarifable->tarif);
        $this->assertArraySubset($tarif_baru, $tarifable->tarif);
    }
}
