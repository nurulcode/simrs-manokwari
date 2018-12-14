<?php

namespace App\Http\Controllers\Kepegawaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KepegawaianController extends Controller
{
    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        return view('kepegawaian.index');
    }
}
