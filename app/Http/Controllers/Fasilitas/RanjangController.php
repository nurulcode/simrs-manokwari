<?php

namespace App\Http\Controllers\Fasilitas;

use Sty\HttpQuery;
use App\Models\Fasilitas\Ranjang;
use App\Http\Requests\Fasilitas\RanjangRequest;
use App\Http\Resources\Fasilitas\RanjangResource;

class RanjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return RanjangResource::collection(Ranjang::withKamar()->filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RanjangRequest $request)
    {
        return response()->crud(
            new RanjangResource(Ranjang::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fasilitas\Ranjang  $ranjang
     * @return \Illuminate\Http\Response
     */
    public function show(Ranjang $ranjang)
    {
        return new RanjangResource($ranjang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fasilitas\Ranjang  $ranjang
     * @return \Illuminate\Http\Response
     */
    public function update(RanjangRequest $request, Ranjang $ranjang)
    {
        return response()->crud(
            new RanjangResource(tap($ranjang)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fasilitas\Ranjang  $ranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ranjang $ranjang)
    {
        return response()->crud(tap($ranjang)->delete());
    }
}
