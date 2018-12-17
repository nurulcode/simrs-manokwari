<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Models\Master\Kasus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\KasusRequest;
use App\Http\Resources\Master\KasusResource;

class KasusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Kasus::class);

        return KasusResource::collection(Kasus::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KasusRequest $request)
    {
        return response()->crud(new KasusResource(
            Kasus::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function show(Kasus $kasus)
    {
        $this->authorize('show', $kasus);

        return new KasusResource($kasus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function update(KasusRequest $request, Kasus $kasus)
    {
        return response()->crud(new KasusResource(
            tap($kasus)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kasus $kasus)
    {
        $this->authorize('delete', $kasus);

        return response()->crud(tap($kasus)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', Kasus::class);

        return view('master.kasus');
    }
}
