<?php

namespace App\Http\Controllers\Fasilitas;

use Sty\HttpQuery;
use App\Models\Fasilitas\Poliklinik;
use App\Http\Resources\Fasilitas\RuanganResource;

class PoliklinikRuanganController extends Controller
{
    public function __invoke(HttpQuery $query, Poliklinik $poliklinik)
    {
        return RuanganResource::collection($poliklinik->ruangans()->filter($query));
    }
}
