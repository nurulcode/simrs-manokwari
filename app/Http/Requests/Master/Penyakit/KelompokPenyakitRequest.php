<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Master\Penyakit\KelompokPenyakit;

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

        return $this->user()->can('create', KelompokPenyakit::class);
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
            'klasifikasi_id' => ['nullable', 'exists:master.klasifikasi_penyakits,id'],
            'icd'            => ['required', 'string', $unique],
            'kode'           => ['required', $unique],
            'uraian'         => ['required'],
            'uraian'         => ['required'],
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
            'klasifikasi_id' => 'klasifikasi',
        ];
    }
}
