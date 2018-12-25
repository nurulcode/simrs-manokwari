<?php

namespace App\Http\Controllers\Perawatan;

use Illuminate\Http\Request;
use App\Enums\KategoriRegistrasi;
use App\Http\Controllers\Controller;
use App\Models\Perawatan\RawatJalan;
use App\Models\Master\JenisRegistrasi;

class RawatJalanWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perawatan.rawat-jalan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_registrasis = JenisRegistrasi::where('kategori', KategoriRegistrasi::RAWAT_JALAN)->get();

        return view('perawatan.rawat-jalan.create', compact(['jenis_registrasis']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perawatan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function show(RawatJalan $rawat_jalan)
    {
        return view('perawatan.rawat-jalan.show', compact(['rawat_jalan']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perawatan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function edit(RawatJalan $rawat_jalan)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perawatan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawatJalan $rawat_jalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perawatan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawatJalan $rawat_jalan)
    {
        //
    }
}
