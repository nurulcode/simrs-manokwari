<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;

class TipeDiagnosaViewController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('master.tipe-diagnosa');
    }
}
