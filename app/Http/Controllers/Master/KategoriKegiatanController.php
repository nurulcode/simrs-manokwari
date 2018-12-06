<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\KategoriKegiatan;
use App\Http\Requests\Master\KategoriKegiatanRequest;
use App\Http\Resources\Master\KategoriKegiatanResource;

class KategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $this->authorize('index', KategoriKegiatan::class);

        return KategoriKegiatanResource::collection(KategoriKegiatan::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriKegiatanRequest $request)
    {
        return response()->crud(new KategoriKegiatanResource(
            KategoriKegiatan::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\KategoriKegiatan  $kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriKegiatan $kategori_kegiatan)
    {
        $this->authorize('show', $kategori_kegiatan);

        return new KategoriKegiatanResource($kategori_kegiatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\KategoriKegiatan  $kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriKegiatanRequest $request, KategoriKegiatan $kategori_kegiatan)
    {
        return response()->crud(new KategoriKegiatanResource(
            tap($kategori_kegiatan)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\KategoriKegiatan  $kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriKegiatan $kategori_kegiatan)
    {
        $this->authorize('delete', $kategori_kegiatan);

        return response()->crud(tap($kategori_kegiatan)->delete());
    }

    /**
     * Display the resource page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $this->authorize('view', KategoriKegiatan::class);

        return view('master.kegiatan');
    }
}
