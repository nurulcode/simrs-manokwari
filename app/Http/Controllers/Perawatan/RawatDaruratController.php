<?php

namespace App\Http\Controllers\Perawatan;

use Sty\HttpQuery;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Perawatan\RawatDarurat;
use App\Http\Resources\Perawatan\RawatDaruratResource;
use App\Http\Requests\Perawatan\CreateRawatDaruratRequest;

class RawatDaruratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return RawatDaruratResource::collection(
            RawatDarurat::with(['kunjungan','poliklinik'])->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRawatDaruratRequest $request)
    {
        $kunjungan   = Kunjungan::create(array_except($request->validated(), [
            'kegiatan_id', 'poliklinik_id', 'jenis_registrasi_id'
        ]));

        $rawat_darurat = new RawatDarurat(array_only($request->validated(), [
            'kegiatan_id', 'poliklinik_id', 'jenis_registrasi_id', 'waktu_kunjungan'
        ]));

        $kunjungan->rawat_darurats()->save($rawat_darurat);

        return response()->crud(new RawatDaruratResource($rawat_darurat));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perawatan\RawatDarurat  $rawat_darurat
     * @return \Illuminate\Http\Response
     */
    public function show(RawatDarurat $rawat_darurat)
    {
        return new RawatDaruratResource($rawat_darurat);
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
        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perawatan\RawatDarurat  $rawat_darurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawatDarurat $rawat_darurat)
    {
        return abort(403);
    }
}
