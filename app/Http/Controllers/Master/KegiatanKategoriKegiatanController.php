<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\KategoriKegiatan;
use App\Http\Resources\Master\KegiatanResource;

class KegiatanKategoriKegiatanController extends Controller
{
    public function __invoke(KategoriKegiatan $kategori, HttpQuery $query)
    {
        return KegiatanResource::collection($kategori->kegiatan()->filter($query));
    }
}
