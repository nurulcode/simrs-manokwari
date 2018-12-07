<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class KegiatanResource extends JsonResource
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
            'parent'      => self::make($this->whenLoaded('parent')),
            'kategori'    => KategoriKegiatanResource::collection($this->whenLoaded('kategori')),
            'uraian'      => $this->uraian,
            'path'        => $this->path,
            '__editable'  => $request->user()->can('update', $this->resource),
            '__deletable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
