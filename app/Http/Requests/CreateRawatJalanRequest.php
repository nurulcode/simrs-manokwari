<?php

namespace App\Http\Requests;

use App\Models\RawatJalan;

class CreateRawatJalanRequest extends KunjunganRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', RawatJalan::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'waktu_kunjungan'     => 'nullable',
            'jenis_registrasi_id' => 'required|exists:jenis_registrasis,id',
            'kegiatan_id'         => 'required|exists:kegiatans,id',
            'poliklinik_id'       => 'required|exists:polikliniks,id',
        ]);
    }
}
