<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewTestCase;

class JenisRegistrasiTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Master\JenisRegistrasi::class;
    }

    public function viewpath()
    {
        return url('master/jenis-registrasi');
    }
}
