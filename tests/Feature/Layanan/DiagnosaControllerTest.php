<?php

namespace Tests\Feature\Layanan;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class DiagnosaControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Layanan\Diagnosa::class;
    }
}
