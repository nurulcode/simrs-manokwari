<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Validation\Rule;
use App\Models\Master\Penyakit\Penyakit;
use Illuminate\Foundation\Http\FormRequest;

class PenyakitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('penyakit')) {
            return $this->user()->can('update', $this->route('penyakit'));
        }

        return $this->user()->can('create', Penyakit::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = Rule::unique('master.penyakits')->ignore(
            optional($this->route('penyakit'))->id
        );

        return [
            'klasifikasi_id' => ['nullable', 'exists:master.klasifikasi_penyakits,id'],
            'kelompok_id'    => ['nullable', 'exists:master.kelompok_penyakits,id'],
            'icd'            => ['required', 'string', $unique],
            'uraian'         => ['required', 'string']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'kelompok_id' => 'kelompok',
        ];
    }
}
