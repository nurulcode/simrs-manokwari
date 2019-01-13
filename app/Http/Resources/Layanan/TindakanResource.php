<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;
use App\Http\Resources\Master\TindakanPemeriksaanResource;

class TindakanResource extends JsonResource
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
            'id'                      => $this->id,
            'tindakan_pemeriksaan_id' => $this->tindakan_pemeriksaan_id,
            'tindakan_pemeriksaan'    => TindakanPemeriksaanResource::make(
                $this->whenLoaded('tindakan_pemeriksaan')
            ),
            'jumlah'     => $this->jumlah,
            'petugas_id' => $this->petugas_id,
            'petugas'    => PegawaiResource::make($this->whenLoaded('petugas')),
            'waktu'      => $this->waktu,
            'tarif'      => $this->tarif,
            'path'       => $this->path,
        ];
    }
}
