<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Foundation\Http\FormRequest;

class KelompokPenyakitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kelompok')) {
            return $this->user()->can('update', $this->route('kelompok'));
        }

        return $this->user()->can('create', KlasifikasiPenyakit::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'klasifikasi_id' => ['nullable'],
            'icd'            => ['required', 'string'],
            'kode'           => ['required'],
            'uraian'         => ['required'],
            'uraian'         => ['required'],
        ];
    }
}
