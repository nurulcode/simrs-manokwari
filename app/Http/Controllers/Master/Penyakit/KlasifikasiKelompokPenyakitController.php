<?php

namespace App\Http\Controllers\Master\Penyakit;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;
use App\Http\Resources\Master\Penyakit\KelompokPenyakitResource;

class KlasifikasiKelompokPenyakitController extends Controller
{
    public function __invoke(HttpQuery $query, KlasifikasiPenyakit $klasifikasi)
    {
        return KelompokPenyakitResource::collection(
            $klasifikasi->kelompok()->filter($query)
        );
    }
}
