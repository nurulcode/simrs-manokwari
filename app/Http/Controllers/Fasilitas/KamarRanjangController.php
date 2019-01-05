<?php

namespace App\Http\Controllers\Fasilitas;

use Sty\HttpQuery;
use App\Models\Fasilitas\Kamar;
use App\Http\Resources\Fasilitas\RanjangResource;

class KamarRanjangController extends Controller
{
    public function __invoke(HttpQuery $query, Kamar $kamar)
    {
        return RanjangResource::collection(
            $kamar->ranjangs()->withKamar()->filter($query)
        );
    }
}
