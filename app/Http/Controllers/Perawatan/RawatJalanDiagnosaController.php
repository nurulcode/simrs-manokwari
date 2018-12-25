<?php

namespace App\Http\Controllers\Perawatan;

use Sty\HttpQuery;
use App\Http\Controllers\Controller;
use App\Models\Perawatan\RawatJalan;
use App\Http\Requests\Layanan\DiagnosaRequest;
use App\Http\Resources\Layanan\DiagnosaResource;

class RawatJalanDiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Pelayanan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function index(RawatJalan $rawat_jalan, HttpQuery $query)
    {
        return DiagnosaResource::collection(
            $rawat_jalan->diagnosa()->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Pelayanan\RawatJalan  $rawat_jalan
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RawatJalan $rawat_jalan, DiagnosaRequest $request)
    {
        return response()->crud(new DiagnosaResource(
            $rawat_jalan->diagnosa()->create($request->validated())
        ));
    }
}
