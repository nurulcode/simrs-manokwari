<?php

namespace App\Http\Controllers\Fasilitas;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas\Poliklinik;
use App\Http\Requests\Fasilitas\PoliklinikRequest;
use App\Http\Resources\Fasilitas\PoliklinikResource;

class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Poliklinik::class);

        return PoliklinikResource::collection(Poliklinik::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PoliklinikRequest $request)
    {
        return response()->crud(new PoliklinikResource(
            Poliklinik::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fasilitas\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function show(Poliklinik $poliklinik)
    {
        $this->authorize('show', $poliklinik);

        return new PoliklinikResource($poliklinik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fasilitas\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function update(PoliklinikRequest $request, Poliklinik $poliklinik)
    {
        return response()->crud(new PoliklinikResource(
            tap($poliklinik)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fasilitas\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poliklinik $poliklinik)
    {
        $this->authorize('delete', $poliklinik);

        return response()->crud(tap($poliklinik)->delete());
    }
}
