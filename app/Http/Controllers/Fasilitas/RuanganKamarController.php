<?php

namespace App\Http\Controllers\Fasilitas;

use Sty\HttpQuery;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ruangan;
use App\Http\Controllers\Controller;
use App\Http\Resources\Fasilitas\KamarResource;

class RuanganKamarController extends Controller
{
    public function __invoke(HttpQuery $query, Ruangan $ruangan)
    {
        $this->authorize('index', Kamar::class);

        return KamarResource::collection(
            $ruangan->kamars()->withRuangan()->filter($query)
        );
    }
}
