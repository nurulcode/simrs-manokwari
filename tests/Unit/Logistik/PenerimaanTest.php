<?php

namespace Tests\Unit\Logistik;

use Tests\TestCase;
use App\Models\Logistik\Penerimaan;
use App\Models\Logistik\Suplier;

class PenerimaanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_suplier()
    {
        $resource = factory(Penerimaan::class)->create();

        $this->assertInstanceOf(Suplier::class, $resource->suplier);
    }
}
