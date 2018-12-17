<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\JenisRujukan;
use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Resource;

class JenisRujukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', JenisRujukan::class);

        return Resource::collection(JenisRujukan::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', JenisRujukan::class);

        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            JenisRujukan::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\JenisRujukan  $jenis_rujukan
     * @return \Illuminate\Http\Response
     */
    public function show(JenisRujukan $jenis_rujukan)
    {
        $this->authorize('show', $jenis_rujukan);

        return new Resource($jenis_rujukan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\JenisRujukan  $jenis_rujukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisRujukan $jenis_rujukan)
    {
        $this->authorize('create', $jenis_rujukan);

        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($jenis_rujukan)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\JenisRujukan  $jenis_rujukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisRujukan $jenis_rujukan)
    {
        $this->authorize('delete', $jenis_rujukan);

        return response()->crud(tap($jenis_rujukan)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', JenisRujukan::class);

        return view('master.jenis-rujukan');
    }
}
