<?php

namespace App\Http\Controllers\Fasilitas;

use Sty\HttpQuery;
use App\Models\Fasilitas\Ruangan;
use App\Http\Resources\Fasilitas\KamarResource;

class RuanganKamarController extends Controller
{
    public function __invoke(HttpQuery $query, Ruangan $ruangan)
    {
        return KamarResource::collection(
            $ruangan->kamars()->withRuangan()->filter($query)
        );
    }
}
