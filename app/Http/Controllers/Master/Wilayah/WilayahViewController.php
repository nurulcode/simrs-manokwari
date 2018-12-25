<?php

namespace App\Http\Controllers\Master\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Master\Controller;

class WilayahViewController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('master.wilayah.index');
    }
}
