<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ranjang;
use App\Models\Fasilitas\Ruangan;
use Illuminate\Support\Collection;
use App\Models\Fasilitas\Poliklinik;

class KamarTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $kamar = factory(Kamar::class)->create();

        $this->assertInstanceof(Ruangan::class, $kamar->ruangan);
    }

    /** @test */
    public function resource_may_has_many_ranjang()
    {
        $kamar = factory(Kamar::class)->create();

        factory(Ranjang::class, 10)->create([
            'kamar_id' => $kamar->id
        ]);

        $this->assertInstanceOf(Collection::class, $kamar->ranjangs);
        $this->assertInstanceOf(Ranjang::class, $kamar->ranjangs->random());
    }

    /** @test */
    public function a_kamar_have_virtual_poliklinik_id()
    {
        $kamar = factory(Kamar::class)->create();

        $kamar = Kamar::find($kamar->id);

        $this->assertSame($kamar->ruangan->poliklinik_id, $kamar->poliklinik_id);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $kamar = factory(Kamar::class)->create();

        $kamar = Kamar::find($kamar->id);

        $this->assertInstanceof(Poliklinik::class, $kamar->poliklinik);
    }
}
