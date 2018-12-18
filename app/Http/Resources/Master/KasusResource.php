<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class KasusResource extends JsonResource
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
            'kode'        => $this->kode,
            'uraian'      => $this->uraian,
            'path'        => $this->path,
            '__editable'  => $request->user()->can('update', $this->resource),
            '__deletable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
