<?php

namespace App\Http\Controllers\Master\Wilayah;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Wilayah\Kecamatan;
use App\Http\Resources\Master\Wilayah\KelurahanResource;

class KecamatanKelurahanController extends Controller
{
    public function __invoke(Kecamatan $kecamatan, HttpQuery $query)
    {
        return KelurahanResource::collection(
            $kecamatan
                ->kelurahans()
                ->with(['provinsi', 'kota_kabupaten', 'kecamatan'])
                ->filter($query)
        );
    }
}
