<?php

namespace App\Http\Requests\Perawatan;

use App\Http\Requests\KunjunganRequest;

class CreateRawatJalanRequest extends KunjunganRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
