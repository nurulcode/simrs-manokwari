<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Tindakan;
use App\Http\Controllers\Controller;
use App\Http\Queries\LayananQuery;
use App\Http\Resources\Layanan\TindakanResource;
use App\Http\Requests\Layanan\TindakanRequest;

class TindakanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_tindakan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return TindakanResource::collection(Tindakan::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TindakanRequest $request)
    {
        return response()->crud(
            new TindakanResource(Tindakan::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Tindakan  $tindakan
     * @return \Illuminate\Http\Response
     */
    public function show(Tindakan $tindakan)
    {
        return new TindakanResource($tindakan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Tindakan  $tindakan
     * @return \Illuminate\Http\Response
     */
    public function update(TindakanRequest $request, Tindakan $tindakan)
    {
        return response()->crud(
            new TindakanResource(tap($tindakan)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Tindakan  $tindakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tindakan $tindakan)
    {
        return response()->crud(tap($tindakan)->delete());
    }
}
