<?php

namespace App\Http\Resources;

use App\Http\Resources\Master\KasusResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'nomor_kunjungan'     => $this->nomor_kunjungan,
            'waktu_kunjungan'     => (string) $this->waktu_kunjungan,
            'pasien_baru'         => $this->pasien_baru,
            'pasien_id'           => $this->pasien_id,
            'pasien'              => PasienResource::make($this->whenLoaded('pasien')),
            'kasus_id'            => $this->kasus_id,
            'kasus'               => KasusResource::make($this->whenLoaded('kasus')),
            'keluhan'             => $this->keluhan,
            'path'                => $this->path,
            '__editable'          => $request->user()->can('update', $this->resource),
            '__deletable'         => $request->user()->can('delete', $this->resource),
        ];
    }
}
