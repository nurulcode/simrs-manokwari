<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'tipe_diagnosa_id' => $this->tipe_diagnosa_id,
            'petugas_id'       => $this->petugas_id,
            'path'             => $this->path,
        ];
    }
}
