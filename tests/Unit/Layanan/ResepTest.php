<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Layanan\Resep;
use App\Models\Perawatan\Perawatan;
use App\Models\Layanan\ResepDetail;
use Illuminate\Support\Collection;

class ResepTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Resep::class)->create();

        $this->assertInstanceof(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function resource_has_may_details()
    {
        $resource = factory(Resep::class)->create();

        factory(ResepDetail::class, 10)->create([
            'resep_id' => $resource->id
        ]);

        $this->assertInstanceof(Collection::class, $resource->details);

        $this->assertInstanceof(ResepDetail::class, $resource->details->random());
    }
}
