<?php

namespace App\Http\Controllers;

use Sty\HttpQuery;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Http\Requests\KunjunganRequest;
use App\Http\Resources\KunjunganResource;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Kunjungan::class);

        return KunjunganResource::collection(Kunjungan::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kunjungan\Kunjungan  $kunjungan
     * @return \Illuminate\Http\Response
     */
    public function show(Kunjungan $kunjungan)
    {
        $this->authorize('show', $kunjungan);

        return new KunjunganResource($kunjungan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kunjungan\Kunjungan  $kunjungan
     * @return \Illuminate\Http\Response
     */
    public function update(KunjunganRequest $request, Kunjungan $kunjungan)
    {
        $kunjungan->update($request->validated());

        return response()->crud(new KunjunganResource($kunjungan->fresh()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kunjungan\Kunjungan  $kunjungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kunjungan $kunjungan)
    {
        return abort(403);
    }
}
