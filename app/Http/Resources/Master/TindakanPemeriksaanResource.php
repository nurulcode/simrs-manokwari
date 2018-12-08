<?php

namespace App\Http\Resources\Master;

use App\Enums\JenisTindakanPemeriksaan;
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
            'id'          => $this->id,
            'parent_id'   => $this->parent_id,
            'kode'        => $this->kode,
            'uraian'      => $this->uraian,
            'jenis'       => JenisTindakanPemeriksaan::toSelectValue($this->jenis),
            'path'        => $this->path,
            '__editable'  => $request->user()->can('update', $this->resource),
            '__deletable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
