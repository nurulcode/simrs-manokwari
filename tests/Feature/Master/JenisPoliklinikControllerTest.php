<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class JenisPoliklinikControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\JenisPoliklinik::class;
    }
}
