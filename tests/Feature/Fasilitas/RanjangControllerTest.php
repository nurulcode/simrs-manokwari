<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class RanjangControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Fasilitas\Ranjang::class;
    }
}
