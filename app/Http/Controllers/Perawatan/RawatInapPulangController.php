<?php

namespace App\Http\Controllers\Perawatan;

use Illuminate\Http\Request;
use App\Models\Perawatan\RawatInap;
use App\Http\Controllers\Controller;
use App\Http\Resources\Perawatan\RawatInapResource;

class RawatInapPulangController extends Controller
{
    public function __invoke(RawatInap $rawat_inap, Request $request)
    {
        $rawat_inap->pulang()->create([
            'waktu_keluar'   => $request->input('waktu_keluar'),
            'keadaan_keluar' => $request->input('keadaan_keluar'),
            'cara_keluar'    => $request->input('cara_keluar'),
        ]);

        return response()->crud(new RawatInapResource($rawat_inap));
    }
}
