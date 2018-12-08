<?php

namespace App\Http\Resources\Master\Penyakit;

use Illuminate\Http\Resources\Json\JsonResource;

class PenyakitResource extends JsonResource
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
            'id'       => $this->id,
            'kelompok' => KelompokPenyakitResource::make($this->whenLoaded('kelompok')),
            'icd'      => $this->icd,
            'uraian'   => $this->uraian,
            'path'     => $this->path,
            '__editable'  => $request->user()->can('update', $this->resource),
            '__deletable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
