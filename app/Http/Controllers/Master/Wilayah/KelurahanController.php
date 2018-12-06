<?php

namespace App\Http\Controllers\Master\Wilayah;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Master\Wilayah\Kelurahan;
use App\Http\Requests\Master\Wilayah\KelurahanRequest;
use App\Http\Resources\Master\Wilayah\KelurahanResource;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Kelurahan::class);

        return KelurahanResource::collection(Kelurahan::withParent()->filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelurahanRequest $request)
    {
        return response()->crud(new KelurahanResource(
            Kelurahan::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Wilayah\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        $this->authorize('show', $kelurahan);

        return new KelurahanResource($kelurahan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Wilayah\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(KelurahanRequest $request, Kelurahan $kelurahan)
    {
        return response()->crud(new KelurahanResource(
            tap($kelurahan)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Wilayah\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        $this->authorize('delete', $kelurahan);

        return response()->crud(tap($kelurahan)->delete());
    }
}