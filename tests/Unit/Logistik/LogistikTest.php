<?php

namespace Tests\Unit\Logistik;

use Tests\TestCase;
use App\Models\Logistik\Logistik;
use App\Models\Master\JenisLogistik;

class LogistikTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_jenis_logistik()
    {
        $resource = factory(Logistik::class)->create();

        $this->assertInstanceOf(JenisLogistik::class, $resource->jenis);
    }
}
