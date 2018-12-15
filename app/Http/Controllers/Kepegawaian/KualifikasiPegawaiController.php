<?php

namespace App\Http\Controllers\Kepegawaian;

use Sty\HttpQuery;
use App\Models\Kepegawaian\Pegawai;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Kualifikasi;
use App\Http\Resources\Kepegawaian\PegawaiResource;

class KualifikasiPegawaiController extends Controller
{
    public function __invoke(HttpQuery $query, Kualifikasi $kualifikasi)
    {
        $this->authorize('index', Pegawai::class);

        return PegawaiResource::collection(
            $kualifikasi->pegawais()->filter($query)
        );
    }
}
