<?php

namespace App\Http\Controllers\Kepegawaian;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Kualifikasi;
use App\Http\Requests\Kepegawaian\KualifikasiRequest;
use App\Http\Resources\Kepegawaian\KualifikasiResource;

class KualifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Kualifikasi::class);

        return KualifikasiResource::collection(Kualifikasi::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KualifikasiRequest $request)
    {
        return response()->crud(new KualifikasiResource(
            Kualifikasi::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kepegawaian\Kualifikasi  $kualifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Kualifikasi $kualifikasi)
    {
        $this->authorize('show', $kualifikasi);

        return new KualifikasiResource($kualifikasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kepegawaian\Kualifikasi  $kualifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(KualifikasiRequest $request, Kualifikasi $kualifikasi)
    {
        return response()->crud(new KualifikasiResource(
            tap($kualifikasi)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kepegawaian\Kualifikasi  $kualifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kualifikasi $kualifikasi)
    {
        $this->authorize('delete', $kualifikasi);

        return response()->crud(tap($kualifikasi)->delete());
    }
}
