<?php

namespace App\Http\Resources;

use App\Http\Resources\Master\KasusResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Master\Penyakit\PenyakitResource;

class KunjunganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'jenis_registrasi_id' => $this->jenis_registrasi_id,
            'kasus'               => KasusResource::make($this->whenLoaded('kasus')),
            'kasus_id'            => $this->kasus_id,
            'keluhan'             => $this->keluhan,
            'nomor_kunjungan'     => $this->nomor_kunjungan,
            'pasien'              => PasienResource::make($this->whenLoaded('pasien')),
            'pasien_baru'         => $this->pasien_baru,
            'pasien_id'           => $this->pasien_id,
            'penyakit_id'         => $this->penyakit_id,
            'penyakit'            => PenyakitResource::make($this->whenLoaded('penyakit')),
            'pj_nama'             => $this->pj_nama,
            'pj_telepon'          => $this->pj_telepon,
            'sjp_nomor'           => $this->sjp_nomor,
            'sjp_tanggal'         => $this->sjp_tanggal,
            'path'                => $this->path,
            'rujukan'             => $this->rujukan,
            'waktu_kunjungan'     => (string) $this->waktu_kunjungan,
            '__editable'          => $request->user()->can('update', $this->resource),
            '__deletable'         => $request->user()->can('delete', $this->resource),
        ];
    }
}
