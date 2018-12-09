<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class PoliklinikControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Fasilitas\Poliklinik::class;
    }
}
