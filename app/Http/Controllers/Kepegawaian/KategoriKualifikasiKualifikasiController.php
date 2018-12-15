<?php

namespace App\Http\Controllers\Kepegawaian;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Kualifikasi;
use App\Models\Kepegawaian\KategoriKualifikasi;
use App\Http\Resources\Kepegawaian\KualifikasiResource;

class KategoriKualifikasiKualifikasiController extends Controller
{
    public function __invoke(HttpQuery $query, KategoriKualifikasi $kategori)
    {
        $this->authorize('index', Kualifikasi::class);

        return KualifikasiResource::collection(
            $kategori->kualifikasis()->filter($query)
        );
    }
}
