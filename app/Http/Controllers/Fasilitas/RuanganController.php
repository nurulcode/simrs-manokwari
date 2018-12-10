<?php

namespace App\Http\Controllers\Fasilitas;

use Sty\HttpQuery;
use App\Models\Fasilitas\Ruangan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fasilitas\RuanganRequest;
use App\Http\Resources\Fasilitas\RuanganResource;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Ruangan::class);

        return RuanganResource::collection(Ruangan::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuanganRequest $request)
    {
        return response()->crud(new RuanganResource(
            Ruangan::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fasilitas\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        $this->authorize('show', $ruangan);

        return new RuanganResource($ruangan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fasilitas\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(RuanganRequest $request, Ruangan $ruangan)
    {
        return response()->crud(new RuanganResource(
            tap($ruangan)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fasilitas\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        $this->authorize('delete', $ruangan);

        return response()->crud(tap($ruangan)->delete());
    }
}
