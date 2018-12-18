<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\CaraPembayaran;
use App\Http\Requests\Master\CaraPembayaranRequest;
use App\Http\Resources\Master\CaraPembayaranResource;

class CaraPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query, Request $request)
    {
        $this->authorize('index', CaraPembayaran::class);

        $cara_pembayaran = CaraPembayaran::query();

        if ($request->filled('parent')) {
            $cara_pembayaran->where('parent_id', null);
        }

        return CaraPembayaranResource::collection($cara_pembayaran->filter($query));
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
        $this->authorize('show', $cara_pembayaran);

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
        return response()->crud(new CaraPembayaranResource(
            tap($cara_pembayaran)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\CaraPembayaran  $cara_pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaraPembayaran $cara_pembayaran)
    {
        $this->authorize('delete', $cara_pembayaran);

        return response()->crud(tap($cara_pembayaran)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', CaraPembayaran::class);

        return view('master.cara-pembayaran');
    }
}
