<?php

namespace App\Http\Requests\Master\Wilayah;

use App\Models\Master\Wilayah\Kecamatan;
use Illuminate\Foundation\Http\FormRequest;

class KecamatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kecamatan')) {
            return $this->user()->can('update', $this->route('kecamatan'));
        }

        return $this->user()->can('create', Kecamatan::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => ['required', 'string', 'max:64'],
            'kota_kabupaten_id' => ['required', 'exists:master.kota_kabupatens,id'],
            'provinsi_id'       => ['required', 'exists:master.provinsis,id']
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
            'provinsi_id'       => 'provinsi',
            'kota_kabupaten_id' => 'kota/kabupaten',
            'name'              => 'nama kecamatan',
        ];
    }
}
