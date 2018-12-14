<?php

namespace App\Http\Controllers\Kepegawaian;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Resource;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KategoriKualifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', KategoriKualifikasi::class);

        return Resource::collection(KategoriKualifikasi::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', KategoriKualifikasi::class);

        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            KategoriKualifikasi::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kepegawaian\KategoriKualifikasi  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriKualifikasi $kategori)
    {
        $this->authorize('show', $kategori);

        return new Resource($kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kepegawaian\KategoriKualifikasi  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriKualifikasi $kategori)
    {
        $this->authorize('update', $kategori);

        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($kategori)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kepegawaian\KategoriKualifikasi  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriKualifikasi $kategori)
    {
        $this->authorize('delete', $kategori);

        return response()->crud(tap($kategori)->delete());
    }
}
