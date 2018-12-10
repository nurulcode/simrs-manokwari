<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class JenisIdentitasControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\JenisIdentitas::class;
    }
}
