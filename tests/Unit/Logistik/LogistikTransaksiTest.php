<?php

namespace Tests\Unit\Logistik;

use Tests\TestCase;
use App\Models\Logistik\Transaksi;
use App\Models\Logistik\Penerimaan;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Logistik\Logistik;

class LogistikTransaksiTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_jenis_transaksi()
    {
        $resource = factory(Transaksi::class)->create([
            'jenis_transaksi_type' => Penerimaan::class
        ]);

        $this->assertInstanceOf(Penerimaan::class, $resource->jenis_transaksi);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = factory(Transaksi::class);

        $this->assertInstanceOf(Poliklinik::class, $resource->apotek);
    }

    /** @test */
    public function resouce_belongs_to_logistik()
    {
        $resource = factory(Transaksi::class)->create();

        $this->assertInstanceOf(Logistik::class, $resource->logistik);
    }
}
