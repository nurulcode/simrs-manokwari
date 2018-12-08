<?php

namespace App\Http\Controllers\Master\Penyakit;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Http\Resources\Master\Penyakit\PenyakitResource;

class KelompokPenyakitPenyakitController extends Controller
{
    public function __invoke(KelompokPenyakit $kelompok, HttpQuery $query)
    {
        return PenyakitResource::collection(
            $kelompok->penyakit()->filter($query)
        );
    }
}
