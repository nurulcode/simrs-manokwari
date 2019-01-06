<?php

namespace App\Http\Resources\Fasilitas;

use Illuminate\Http\Resources\Json\JsonResource;

class RuanganResource extends JsonResource
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
            'id'            => $this->id,
            'poliklinik_id' => $this->poliklinik_id,
            'poliklinik'    => PoliklinikResource::make($this->whenLoaded('poliklinik')),
            'nama'          => $this->nama,
            'kode'          => $this->kode,
            'kelas'         => $this->kelas,
            'jenis'         => $this->jenis,
            'path'          => $this->path,
        ];
    }
}
