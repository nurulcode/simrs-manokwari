<?php

namespace App\Http\Controllers\Perawatan;

use Illuminate\Http\Request;
use App\Enums\KategoriRegistrasi;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Master\JenisRegistrasi;
use App\Models\Perawatan\RawatDarurat;

class RawatDaruratWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perawatan.rawat-darurat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $polikliniks       = Poliklinik::where('jenis_id', 2)->get();

        $kategori_kegiatan = 3;

        $jenis_registrasis = JenisRegistrasi::where(
            'kategori', KategoriRegistrasi::GAWAT_DARURAT
        )->get();

        return view('perawatan.rawat-darurat.create', compact([
            'jenis_registrasis', 'polikliniks', 'kategori_kegiatan'
        ]));
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
     * @param  \App\Models\Perawatan\RawatDarurat  $rawat_darurat
     * @return \Illuminate\Http\Response
     */
    public function show(RawatDarurat $rawat_darurat)
    {
        return view('perawatan.rawat-darurat.show', compact(['rawat_darurat']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perawatan\RawatDarurat  $rawat_darurat
     * @return \Illuminate\Http\Response
     */
    public function edit(RawatDarurat $rawat_darurat)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perawatan\RawatDarurat  $rawat_darurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawatDarurat $rawat_darurat)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perawatan\RawatDarurat  $rawat_darurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawatDarurat $rawat_darurat)
    {
        abort(403);
    }
}
