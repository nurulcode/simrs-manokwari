<?php

namespace Tests\Feature\Penunjang;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;

class RadiologiTest extends TestCase
{
    use ResourceViewTestCase;

    public function viewpath()
    {
        return url('penunjang/radiologi');
    }
}
