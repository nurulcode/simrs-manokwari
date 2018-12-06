<?php

namespace App\Http\Resources\Master\Wilayah;

use Illuminate\Http\Resources\Json\JsonResource;

class KecamatanResource extends JsonResource
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
            'kota_kabupaten_id'   => $this->kota_kabupaten_id,
            'kota_kabupaten_name' => $this->when($this->kota_kabupaten_name, $this->kota_kabupaten_name),
            'kota_kabupaten'      => KotaKabupatenResource::make($this->whenLoaded('kota_kabupaten')),
            'provinsi_name'       => $this->when($this->provinsi_name, $this->provinsi_name),
            'path'                => $this->path,
            '__editable'          => $request->user()->can('update', $this->resource),
            '__deletable'         => $request->user()->can('delete', $this->resource),
        ];
    }
}
