<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;

class PendidikanViewController extends Controller
{
    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('master.pendidikan');
    }
}