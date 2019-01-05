<?php

namespace App\Http\Controllers\Fasilitas;

use Illuminate\Http\Request;

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
