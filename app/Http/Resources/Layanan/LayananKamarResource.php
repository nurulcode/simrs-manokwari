<?php

namespace App\Http\Resources\Layanan;

use App\Http\Resources\Fasilitas\KamarResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Fasilitas\RanjangResource;
use App\Http\Resources\Fasilitas\RuanganResource;
use App\Http\Resources\Fasilitas\PoliklinikResource;

class LayananKamarResource extends JsonResource
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
            'waktu_masuk'   => (string) $this->waktu_masuk,
            'waktu_keluar'  => (string) $this->waktu_keluar,
            'ranjang_id'    => $this->ranjang_id,
            'ranjang'       => RanjangResource::make($this->whenLoaded('ranjang')),
            'kamar_id'      => $this->kamar_id,
            'kamar'         => KamarResource::make($this->whenLoaded('kamar')),
            'ruangan_id'    => $this->ruangan_id,
            'ruangan'       => RuanganResource::make($this->whenLoaded('ruangan')),
            'poliklinik_id' => $this->poliklinik_id,
            'poliklinik'    => PoliklinikResource::make($this->whenLoaded('poliklinik')),
        ];
    }
}
