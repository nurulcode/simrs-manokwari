<?php

namespace App\Http\Controllers\Master\Wilayah;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Wilayah\Provinsi;
use App\Http\Requests\Master\Wilayah\ProvinsiRequest;
use App\Http\Resources\Master\Wilayah\ProvinsiResource;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Provinsi::class);

        return ProvinsiResource::collection(Provinsi::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinsiRequest $request)
    {
        return response()->crud(new ProvinsiResource(
            Provinsi::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Wilayah\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show(Provinsi $provinsi)
    {
        $this->authorize('view', $provinsi);

        return new ProvinsiResource($provinsi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Wilayah\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinsiRequest $request, Provinsi $provinsi)
    {
        return response()->crud(new ProvinsiResource(
            tap($provinsi)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Wilayah\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinsi $provinsi)
    {
        $this->authorize('delete', $provinsi);

        return response()->crud(tap($provinsi)->delete());
    }
}
