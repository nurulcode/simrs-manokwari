<?php

namespace App\Http\Controllers\Perawatan;

use Sty\HttpQuery;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Models\Perawatan\RawatInap;
use App\Http\Controllers\Controller;
use App\Http\Resources\Perawatan\RawatInapResource;
use App\Http\Requests\Perawatan\CreateRawatInapRequest;

class RawatInapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return RawatInapResource::collection(RawatInap::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Perawatan\CreateRawatInapRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRawatInapRequest $request)
    {
        $kunjungan  = Kunjungan::create($request->validated());

        $rawat_inap = RawatInap::make($request->validated());

        $kunjungan->rawat_inaps()->save($rawat_inap);

        return response()->crud(new RawatInapResource($rawat_inap));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perawatan\RawatInap  $rawat_inap
     * @return \Illuminate\Http\Response
     */
    public function show(RawatInap $rawat_inap)
    {
        return new RawatInapResource($rawat_inap);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perawatan\RawatInap  $rawat_inap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawatInap $rawat_inap)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perawatan\RawatInap  $rawat_inap
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawatInap $rawat_inap)
    {
        abort(403);
    }
}
