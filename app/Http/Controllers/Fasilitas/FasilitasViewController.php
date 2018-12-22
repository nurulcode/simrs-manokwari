<?php

namespace App\Http\Controllers\Fasilitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FasilitasViewController extends Controller
{
    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('fasilitas.index');
    }
}
