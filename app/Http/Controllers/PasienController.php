<?php

namespace App\Http\Controllers;

use Sty\HttpQuery;
use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Requests\PasienRequest;
use App\Http\Resources\PasienResource;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Pasien::class);

        return PasienResource::collection(Pasien::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PasienRequest $request)
    {
        return response()->crud(new PasienResource(
            Pasien::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(Pasien $pasien)
    {
        $this->authorize('show', $pasien);

        return new PasienResource($pasien);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(PasienRequest $request, Pasien $pasien)
    {
        return response()->crud(new PasienResource(
            tap($pasien)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien)
    {
        $this->authorize('delete', $pasien);

        return response()->crud(tap($pasien)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', Pasien::class);

        return view('pasien');
    }
}
