<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\CaraPembayaran;
use App\Http\Queries\CaraPembayaranQuery;
use App\Http\Requests\Master\CaraPembayaranRequest;
use App\Http\Resources\Master\CaraPembayaranResource;

class CaraPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CaraPembayaranQuery $query, Request $request)
    {
        return CaraPembayaranResource::collection(CaraPembayaran::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CaraPembayaranRequest $request)
    {
        return response()->crud(new CaraPembayaranResource(
            CaraPembayaran::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\CaraPembayaran  $cara_pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(CaraPembayaran $cara_pembayaran)
    {
        return new CaraPembayaranResource($cara_pembayaran);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\CaraPembayaran  $cara_pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(CaraPembayaranRequest $request, CaraPembayaran $cara_pembayaran)
    {
        return response()->crud(
            new CaraPembayaranResource(
                tap($cara_pembayaran)->update($request->validated())
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\CaraPembayaran  $cara_pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaraPembayaran $cara_pembayaran)
    {
        return response()->crud(tap($cara_pembayaran)->delete());
    }
}
