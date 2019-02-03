<?php

namespace Tests\Feature\Logistik;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class TransaksiControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Logistik\Transaksi::class;
    }
}
