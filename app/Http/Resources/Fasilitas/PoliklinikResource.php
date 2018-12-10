<?php

namespace App\Http\Resources\Fasilitas;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Master\JenisPoliklinikResource;

class PoliklinikResource extends JsonResource
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
            'nama'        => $this->nama,
            'kode'        => $this->kode,
            'jenis_id'    => $this->jenis_id,
            'jenis'       => JenisPoliklinikResource::make($this->whenLoaded('jenis')),
            'path'        => $this->path,
            '__editable'  => $request->user()->can('update', $this->resource),
            '__deletable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
