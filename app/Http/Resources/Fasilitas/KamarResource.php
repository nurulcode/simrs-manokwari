<?php

namespace App\Http\Resources\Fasilitas;

use Illuminate\Http\Resources\Json\JsonResource;

class KamarResource extends JsonResource
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
            'id'           => $this->id,
            'ruangan_id'   => $this->ruangan_id,
            'ruangan'      => RuanganResource::make($this->whenLoaded('ruangan')),
            'nama_ruangan' => $this->when($this->nama_ruangan, $this->nama_ruangan),
            'nama'         => $this->nama,
            'path'         => $this->path,
            '__editable'   => $request->user()->can('update', $this->resource),
            '__deletable'  => $request->user()->can('delete', $this->resource),
        ];
    }
}
