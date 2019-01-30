<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan\Penunjang;

class PenunjangViewController extends Controller
{
    public function __invoke($slug, Penunjang $penunjang, Request $request)
    {
        return view('penunjang.show', [
            'title'     => 'Data Pasien ' . ucwords(str_replace('-', ' ', $slug)),
            'penunjang' => $penunjang,
            'kunjungan' => $penunjang->perawatan->kunjungan,
            'perawatan' => $penunjang->perawatan
        ]);
    }
}
