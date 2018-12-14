<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class KategoriKualifikasiControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Kepegawaian\KategoriKualifikasi::class;
    }
}
