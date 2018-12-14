<?php

namespace App\Http\Resources;

use App\Enums\JenisKelamin;
use App\Enums\GolonganDarah;
use App\Enums\StatusPernikahan;
use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Master\Wilayah\KelurahanResource;

class PasienResource extends JsonResource
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
            'id'                 => $this->id,
            'tanggal_registrasi' => $this->tanggal_registrasi->toDateTimeString(),
            'no_rekam_medis'     => $this->no_rekam_medis,
            'nama'               => $this->nama,
            'jenis_identitas_id' => $this->jenis_identitas_id,
            'jenis_identitas'    => Resource::make($this->whenLoaded('jenis_identitas')),
            'nomor_identitas'    => $this->nomor_identitas,
            'jenis_kelamin'      => JenisKelamin::toSelectValue($this->jenis_kelamin),
            'agama_id'           => $this->agama_id,
            'agama'              => Resource::make($this->whenLoaded('agama')),
            'suku_id'            => $this->suku_id,
            'suku'               => Resource::make($this->whenLoaded('suku')),
            'golongan_darah'     => GolonganDarah::toSelectValue($this->golongan_darah),
            'tempat_lahir'       => $this->tempat_lahir,
            'tanggal_lahir'      => optional($this->tanggal_lahir)->toDateTimeString(),
            'pekerjaan_id'       => $this->pekerjaan_id,
            'pekerjaan'          => Resource::make($this->whenLoaded('pekerjaan')),
            'pendidikan_id'      => $this->pendidikan_id,
            'pendidikan'         => Resource::make($this->whenLoaded('pendidikan')),

            'alamat'             => $this->alamat,
            'kelurahan_id'       => $this->kelurahan_id,
            'kelurahan'          => KelurahanResource::make($this->whenLoaded('kelurahan')),
            'telepon'            => $this->telepon,

            'nama_ayah'          => $this->nama_ayah,
            'nama_ibu'           => $this->nama_ibu,
            'status_pernikahan'  => StatusPernikahan::toSelectValue($this->status_pernikahan),
            'nama_pasangan'      => $this->nama_pasangan,
            'alamat_keluarga'    => $this->alamat_keluarga,
            'telepon_keluarga'   => $this->telepon_keluarga,

            'path'               => $this->path,
            '__editable'         => $request->user()->can('update', $this->resource),
            '__deletable'        => $request->user()->can('delete', $this->resource),
        ];
    }
}
