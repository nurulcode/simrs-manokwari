<?php

namespace App\Http\Resources\Logistik;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Fasilitas\PoliklinikResource;

class TransaksiResource extends JsonResource
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
            'id'                   => $this->id,
            'jenis_transaksi_type' => $this->jenis_transaksi_type,
            'jenis_transaksi_id'   => $this->jenis_transaksi_id,
            'jenis_transaksi'      => $this->whenLoaded('jenis_transaksi'),
            'apotek_id'            => $this->apotek_id,
            'apotek'               => PoliklinikResource::make($this->whenLoaded('apotek')),
            'logistik_id'          => $this->logistik_id,
            'logistik'             => LogistikResource::make($this->whenLoaded('logistik')),
            'harga'                => $this->harga,
            'jumlah'               => $this->jumlah,
            'path'                 => $this->path,
        ];
    }
}
