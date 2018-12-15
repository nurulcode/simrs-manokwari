<?php

namespace Tests\Unit\Kepegawaian;

use Tests\TestCase;
use App\Models\Kepegawaian\Kualifikasi;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KualifikasiTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_kategori()
    {
        $kualifikasi = factory(Kualifikasi::class)->create();

        $this->assertInstanceof(KategoriKualifikasi::class, $kualifikasi->kategori);
    }
}
