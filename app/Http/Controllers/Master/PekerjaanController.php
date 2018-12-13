<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\Pekerjaan;
use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Resource;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Pekerjaan::class);

        return Resource::collection(Pekerjaan::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Pekerjaan::class);

        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            Pekerjaan::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        $this->authorize('show', $pekerjaan);

        return new Resource($pekerjaan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $this->authorize('update', $pekerjaan);

        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($pekerjaan)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        $this->authorize('delete', $pekerjaan);

        return response()->crud(tap($pekerjaan)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', Pekerjaan::class);

        return view('master.pekerjaan');
    }
}
