<?php

namespace App\Http\Controllers\Master\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\Master\Wilayah\Kecamatan;
use App\Http\Queries\Master\Wilayah\KecamatanQuery;
use App\Http\Requests\Master\Wilayah\KecamatanRequest;
use App\Http\Resources\Master\Wilayah\KecamatanResource;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KecamatanQuery $query)
    {
        $this->authorize('index', Kecamatan::class);

        return KecamatanResource::collection(Kecamatan::withParent()->filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KecamatanRequest $request)
    {
        return response()->crud(new KecamatanResource(
            Kecamatan::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Wilayah\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        $this->authorize('show', $kecamatan);

        return new KecamatanResource($kecamatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Wilayah\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(KecamatanRequest $request, Kecamatan $kecamatan)
    {
        return response()->crud(new KecamatanResource(
            tap($kecamatan)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Wilayah\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $this->authorize('delete', $kecamatan);

        return response()->crud(tap($kecamatan)->delete());
    }
}
