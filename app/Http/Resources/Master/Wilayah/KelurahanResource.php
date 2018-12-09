<?php

namespace App\Http\Resources\Master\Wilayah;

use Illuminate\Http\Resources\Json\JsonResource;

class KelurahanResource extends JsonResource
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
            'id'                  => $this->id,
            'name'                => $this->name,
            'kecamatan_id'        => $this->kecamatan_id,
            'kecamatan_name'      => $this->when($this->kecamatan_name, $this->kecamatan_name),
            'kota_kabupaten_name' => $this->when($this->kota_kabupaten_name, $this->kota_kabupaten_name),
            'kecamatan'           => KecamatanResource::make($this->whenLoaded('kecamatan')),
            'path'                => $this->path,
            '__editable'          => $request->user()->can('update', $this->resource),
            '__deletable'         => $request->user()->can('delete', $this->resource),
        ];
    }
}
