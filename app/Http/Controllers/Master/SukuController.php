<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Models\Master\Suku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Resource;

class SukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', Suku::class);

        return Resource::collection(Suku::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Suku::class);

        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            Suku::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Suku  $suku
     * @return \Illuminate\Http\Response
     */
    public function show(Suku $suku)
    {
        $this->authorize('show', $suku);

        return new Resource($suku);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Suku  $suku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suku $suku)
    {
        $this->authorize('update', $suku);

        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($suku)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Suku  $suku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suku $suku)
    {
        $this->authorize('delete', $suku);

        return response()->crud(tap($suku)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', Suku::class);

        return view('master.suku');
    }
}
