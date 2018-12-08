<?php

namespace Tests\Feature\Master\Penyait;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class KelompokPenyakitControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Penyakit\KelompokPenyakit::class;
    }
}
