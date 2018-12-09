<?php

namespace App\Http\Controllers\Fasilitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FasilitasController extends Controller
{
    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        return view('fasilitas.index');
    }
}
