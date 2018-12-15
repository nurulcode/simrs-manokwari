<?php

namespace App\Http\Controllers\Kepegawaian;

use Sty\HttpQuery;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Pegawai;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kepegawaian\PegawaiResource;

class JabatanPegawaiController extends Controller
{
    public function __invoke(HttpQuery $query, Jabatan $jabatan)
    {
        $this->authorize('index', Pegawai::class);

        return PegawaiResource::collection(
            $jabatan->pegawais()->filter($query)
        );
    }
}
