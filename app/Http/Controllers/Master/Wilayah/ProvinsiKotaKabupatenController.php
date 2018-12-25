<?php

namespace App\Http\Controllers\Master\Wilayah;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Wilayah\Provinsi;
use App\Http\Resources\Master\Wilayah\KotaKabupatenResource;

class ProvinsiKotaKabupatenController extends Controller
{
    public function __invoke(Provinsi $provinsi, HttpQuery $query)
    {
        return KotaKabupatenResource::collection(
            $provinsi->kota_kabupaten()->withParent()->filter($query)
        );
    }
}
