<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use App\Models\Master\TindakanPemeriksaan;

class TindakanPemeriksaanTest extends TestCase
{
    /** @test */
    public function a_kegiatan_belongs_to_itself()
    {
        $tindakan = factory(TindakanPemeriksaan::class)->create([
            'parent_id' => function () {
                return factory(TindakanPemeriksaan::class)->create()->id;
            }
        ]);

        $this->assertInstanceof(TindakanPemeriksaan::class, $tindakan->parent);
    }
}
