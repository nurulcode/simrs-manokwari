<?php

namespace App\Http\Requests\Layanan;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('manage_diagnosa');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'penyakit_id'      => 'required',
            'lama_menderita'   => 'nullable',
            'kasus'            => 'required',
            'tipe_diagnosa_id' => 'required',
            'petugas_id'       => 'required',
        ];
    }
}
