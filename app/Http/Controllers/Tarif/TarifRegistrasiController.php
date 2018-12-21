<?php

namespace App\Http\Controllers\Tarif;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tarif\TarifRegistrasi;
use App\Http\Requests\Tarif\TarifRegistrasiRequest;
use App\Http\Resources\Tarif\TarifRegistrasiResource;

class TarifRegistrasiController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', TarifRegistrasi::class);

        return TarifRegistrasiResource::collection(TarifRegistrasi::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TarifRegistrasiRequest $request)
    {
        return response()->crud(new TarifRegistrasiResource(
            TarifRegistrasi::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\TarifRegistrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function show(TarifRegistrasi $registrasi)
    {
        $this->authorize('show', $registrasi);

        return new TarifRegistrasiResource($registrasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\TarifRegistrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function update(TarifRegistrasiRequest $request, TarifRegistrasi $registrasi)
    {
        return response()->crud(new TarifRegistrasiResource(
            tap($registrasi)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\TarifRegistrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(TarifRegistrasi $registrasi)
    {
        $this->authorize('delete', $registrasi);

        return response()->crud(tap($registrasi)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', TarifRegistrasi::class);

        return view('tarif.registrasi');
    }
}
