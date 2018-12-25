<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewControllerTestCase;

class PendidikanControllerTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Pendidikan::class;
    }
}
