<?php

namespace App\Http\Controllers\Master\Wilayah;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Wilayah\KotaKabupaten;
use App\Http\Resources\Master\Wilayah\KecamatanResource;

class KotaKabupatenKecamatanController extends Controller
{
    public function __invoke(KotaKabupaten $kota_kabupaten, HttpQuery $query)
    {
        return KecamatanResource::collection(
            $kota_kabupaten
                ->kecamatans()
                ->with('provinsi', 'kota_kabupaten')
                ->filter($query)
        );
    }
}
