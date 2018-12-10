<?php

namespace App\Http\Controllers\Master\Wilayah;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;
use App\Http\Resources\Master\Wilayah\KelurahanResource;

class KecamatanKelurahanController extends Controller
{
    public function __invoke(Kecamatan $kecamatan, HttpQuery $query)
    {
        $this->authorize('index', Kelurahan::class);

        return KelurahanResource::collection(
            $kecamatan->kelurahans()->withParent()->filter($query)
        );
    }
}
