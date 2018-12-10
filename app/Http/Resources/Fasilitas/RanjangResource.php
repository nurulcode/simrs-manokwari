<?php

namespace App\Http\Resources\Fasilitas;

use Illuminate\Http\Resources\Json\JsonResource;

class RanjangResource extends JsonResource
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
            'id'          => $this->id,
            'kamar_id'    => $this->kamar_id,
            'kamar'       => KamarResource::make($this->whenLoaded('kamar')),
            'nama_kamar'  => $this->when($this->nama_kamar, $this->nama_kamar),
            'nama_ruangan' => $this->when($this->nama_ruangan, $this->nama_ruangan),
            'kode'        => $this->kode,
            'path'        => $this->path,
            '__editable'  => $request->user()->can('update', $this->resource),
            '__deletable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
