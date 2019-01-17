<?php

namespace Tests\Unit;

use App\Enums;
use Tests\TestCase;
use App\Models\Tarif;
use App\Models\Master\TindakanPemeriksaan;

class TarifTest extends TestCase
{
    /** @test **/
    public function user_can_set_tarif_for_resource()
    {
        $tarifable = factory(TindakanPemeriksaan::class)->create();

        $tarif = [
            Enums\KelasTarif::KELAS_VVIP => [
                Enums\JenisTarif::SARANA    => 10000,
                Enums\JenisTarif::PELAYANAN => 10000,
                Enums\JenisTarif::BHP       => 10000,
            ]
        ];

        $tarifable->tarif()->create(compact('tarif'));

        $tarifable = TindakanPemeriksaan::find($tarifable->id);

        $this->assertDatabaseHas('tarifs', [
            'tarifable_type' => TindakanPemeriksaan::class,
            'tarifable_id'   => $tarifable->id,
        ]);

        $this->assertArrayHasKey(Enums\KelasTarif::KELAS_VVIP, $tarifable->tarif);

        $this->assertCount(
            count(array_unique(Enums\KelasTarif::getValues())), $tarifable->tarif
        );

        $this->assertArraySubset($tarif, $tarifable->tarif);
    }

    /** @test */
    public function user_can_update_subset_of_tarif()
    {
        $tarifable = factory(TindakanPemeriksaan::class)->create();

        $tarif = [
            Enums\KelasTarif::KELAS_VVIP => [
                Enums\JenisTarif::SARANA    => 10000,
                Enums\JenisTarif::PELAYANAN => 10000,
                Enums\JenisTarif::BHP       => 10000,
            ]
        ];

        $tarifable->tarif()->create(compact('tarif'));

        $tarif_baru = [
            Enums\KelasTarif::KELAS_I => [
                Enums\JenisTarif::SARANA    => 15000,
                Enums\JenisTarif::PELAYANAN => 15000,
                Enums\JenisTarif::BHP       => 15000,
            ]
        ];

        Tarif::updateOrCreate([
            'tarifable_type' => get_class($tarifable),
            'tarifable_id'   => $tarifable->id,
        ], [
            'tarif'          => $tarif_baru
        ]);

        $tarifable = TindakanPemeriksaan::find($tarifable->id);

        $this->assertDatabaseHas('tarifs', [
            'tarifable_type' => TindakanPemeriksaan::class,
            'tarifable_id'   => $tarifable->id,
        ]);

        $this->assertArrayHasKey(Enums\KelasTarif::KELAS_VVIP, $tarifable->tarif);
        $this->assertArrayHasKey(Enums\KelasTarif::KELAS_I, $tarifable->tarif);

        $this->assertCount(
            count(array_unique(Enums\KelasTarif::getValues())), $tarifable->tarif
        );

        $this->assertArraySubset($tarif, $tarifable->tarif);
        $this->assertArraySubset($tarif_baru, $tarifable->tarif);
    }
}
