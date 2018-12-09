<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\JenisPoliklinik;
use App\Http\Requests\Master\JenisPoliklinikRequest;
use App\Http\Resources\Master\JenisPoliklinikResource;

class JenisPoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', JenisPoliklinik::class);

        return JenisPoliklinikResource::collection(
            JenisPoliklinik::filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisPoliklinikRequest $request)
    {
        return response()->crud(new JenisPoliklinikResource(
            JenisPoliklinik::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\JenisPoliklinik  $jenis_poliklinik
     * @return \Illuminate\Http\Response
     */
    public function show(JenisPoliklinik $jenis_poliklinik)
    {
        $this->authorize('show', $jenis_poliklinik);

        return new JenisPoliklinikResource($jenis_poliklinik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\JenisPoliklinik  $jenis_poliklinik
     * @return \Illuminate\Http\Response
     */
    public function update(JenisPoliklinikRequest $request, JenisPoliklinik $jenis_poliklinik)
    {
        return response()->crud(new JenisPoliklinikResource(
            tap($jenis_poliklinik)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\JenisPoliklinik  $jenis_poliklinik
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisPoliklinik $jenis_poliklinik)
    {
        $this->authorize('delete', $jenis_poliklinik);

        return response()->crud(tap($jenis_poliklinik)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', JenisPoliklinik::class);

        return view('master.jenis-poliklinik');
    }
}
