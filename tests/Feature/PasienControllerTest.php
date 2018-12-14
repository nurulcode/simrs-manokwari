<?php

namespace Tests\Feature;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class PasienControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Pasien::class;
    }

    public function matchDatabase($resource)
    {
        return array_except($resource->getAttributes(), 'tanggal_registrasi');
    }
}
