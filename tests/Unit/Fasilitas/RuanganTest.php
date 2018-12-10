<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ruangan;
use Illuminate\Support\Collection;
use App\Models\Fasilitas\Poliklinik;

class RuanganTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $ruangan = factory(Ruangan::class)->create();

        $this->assertInstanceof(Poliklinik::class, $ruangan->poliklinik);
    }

    /** @test */
    public function resource_may_has_many_kamar()
    {
        $ruangan = factory(Ruangan::class)->create();

        factory(Kamar::class, 10)->create([
            'ruangan_id' => $ruangan->id
        ]);

        $this->assertInstanceOf(Collection::class, $ruangan->kamars);
        $this->assertInstanceOf(Kamar::class, $ruangan->kamars->random());
    }
}
