<?php

namespace App\Http\Resources\Perawatan;

use Illuminate\Http\Resources\Json\JsonResource;

class RawatInapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
