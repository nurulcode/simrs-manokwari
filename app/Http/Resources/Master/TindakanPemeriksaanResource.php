<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class TindakanPemeriksaanResource extends JsonResource
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
            'id'        => $this->id,
            'parent_id' => $this->parent_id,
            'parent'    => self::make($this->whenLoaded('parent')),
            'kode'      => $this->kode,
            'uraian'    => $this->uraian,
            'jenis'     => $this->jenis,
            'path'      => $this->path,
        ];
    }
}
