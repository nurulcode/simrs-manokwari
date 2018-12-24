<?php

namespace App\Http\Resources\Pelayanan;

use App\Http\Resources\KunjunganResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\PotentiallyMissing;
use App\Http\Resources\Fasilitas\PoliklinikResource;

class RawatJalanResource extends JsonResource
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
            'id'            => $this->id,
            'poliklinik_id' => $this->poliklinik_id,
            'poliklinik'    => PoliklinikResource::make($this->whenLoaded('poliklinik')),
            'pelayanan'     => $this->whenLoaded('pelayanan'),
            'kunjungan'     => KunjunganResource::make($this->getKunjungan()),
            'path'          => $this->path
        ];
    }

    public function getKunjungan()
    {
        if (!$this->whenLoaded('pelayanan') instanceof PotentiallyMissing) {
            return $this->pelayanan->kunjungan;
        }
    }
}
