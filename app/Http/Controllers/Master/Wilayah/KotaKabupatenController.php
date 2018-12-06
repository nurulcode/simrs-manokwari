<?php

namespace App\Http\Controllers\Master\Wilayah;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Wilayah\KotaKabupaten;
use App\Http\Requests\Master\Wilayah\KotaKabupatenRequest;
use App\Http\Resources\Master\Wilayah\KotaKabupatenResource;

class KotaKabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', KotaKabupaten::class);

        return KotaKabupatenResource::collection(
            KotaKabupaten::withParent()->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KotaKabupatenRequest $request)
    {
        return response()->crud(new KotaKabupatenResource(
            KotaKabupaten::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Wilayah\KotaKabupaten  $kota_kabupaten
     * @return \Illuminate\Http\Response
     */
    public function show(KotaKabupaten $kota_kabupaten)
    {
        $this->authorize('show', $kota_kabupaten);

        return new KotaKabupatenResource($kota_kabupaten);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Wilayah\KotaKabupaten  $kota_kabupaten
     * @return \Illuminate\Http\Response
     */
    public function update(KotaKabupatenRequest $request, KotaKabupaten $kota_kabupaten)
    {
        return response()->crud(new KotaKabupatenResource(
            tap($kota_kabupaten)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Wilayah\KotaKabupaten  $kota_kabupaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(KotaKabupaten $kota_kabupaten)
    {
        $this->authorize('delete', $kota_kabupaten);

        return response()->crud(tap($kota_kabupaten)->delete());
    }
}
