<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Validation\Rule;
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
        $unique = Rule::unique('master.kelompok_penyakits')->ignore(
            optional($this->route('kelompok'))->id
        );

        return [
            'klasifikasi_id' => ['nullable'],
            'icd'            => ['required', 'string', $unique],
            'kode'           => ['required', $unique],
            'uraian'         => ['required'],
            'uraian'         => ['required'],
        ];
    }
}
