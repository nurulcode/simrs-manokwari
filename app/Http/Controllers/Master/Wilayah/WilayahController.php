<?php

namespace App\Http\Controllers\Master\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WilayahController extends Controller
{
    public function view(Request $request)
    {
        return view('master.wilayah.index');
    }
}
