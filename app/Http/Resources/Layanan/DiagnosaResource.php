<?php

namespace App\Http\Resources\Layanan;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;
use App\Http\Resources\Master\Penyakit\PenyakitResource;

class DiagnosaResource extends JsonResource
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
            'id'               => $this->id,
            'lama_menderita'   => $this->lama_menderita,
            'kasus'            => $this->kasus,
            'penyakit_id'      => $this->penyakit_id,
            'penyakit'         => PenyakitResource::make($this->whenLoaded('penyakit')),
            'tipe_diagnosa_id' => $this->tipe_diagnosa_id,
            'tipe'             => Resource::make($this->whenLoaded('tipe')),
            'petugas_id'       => $this->petugas_id,
            'petugas'          => PegawaiResource::make($this->whenLoaded('petugas')),
            'waktu'            => $this->waktu,
            'path'             => $this->path,
        ];
    }
}
