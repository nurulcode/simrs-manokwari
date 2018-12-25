<?php

namespace App\Http\Controllers\Master\Penyakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Master\Controller;

class PenyakitViewController extends Controller
{
    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('master.penyakit.index');
    }
}
