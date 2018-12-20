<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KunjunganRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis_registrasi_id' => ['required'],
            'pasien_id'           => ['required'],
            'keluhan'             => ['required'],

            'pasien_baru'         => ['nullable'],
            'waktu_kunjungan'     => ['nullable'],
            'kasus_id'            => ['nullable'],
            'penyakit_id'         => ['nullable'],

            'rujukan.jenis_id'    => ['nullable'],
            'rujukan.asal'        => ['nullable'],
            'rujukan.nomor'       => ['nullable'],
            'rujukan.tanggal'     => ['nullable'],

            'pj_nama'             => ['nullable', 'string'],
            'pj_telepon'          => ['nullable', 'string'],

            'cara_pembayaran_id'  => ['nullable'],
            'sjp_nomor'           => ['nullable'],
            'sjp_tanggal'         => ['nullable'],
        ];
    }
}
