<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrasiRawatJalan;
use App\Models\Kunjungan\RawatJalan;
use App\Http\Resources\RawatJalanResource;
use App\Http\Requests\CreateRawatJalanRequest;

class RawatJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRawatJalanRequest $request)
    {
        return response()->crud(new RawatJalanResource(
            RegistrasiRawatJalan::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kunjungan\RawatJalan  $rawatJalan
     * @return \Illuminate\Http\Response
     */
    public function show(RawatJalan $rawatJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kunjungan\RawatJalan  $rawatJalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawatJalan $rawatJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kunjungan\RawatJalan  $rawatJalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawatJalan $rawatJalan)
    {
        //
    }
}
