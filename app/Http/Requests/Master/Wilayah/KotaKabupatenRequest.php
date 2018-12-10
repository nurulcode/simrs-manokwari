<?php

namespace App\Http\Requests\Master\Wilayah;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Master\Wilayah\KotaKabupaten;

class KotaKabupatenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kota_kabupaten')) {
            return $this->user()->can('update', $this->route('kota_kabupaten'));
        }

        return $this->user()->can('create', KotaKabupaten::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:64'],
            'provinsi_id' => ['required', 'exists:provinsis,id']
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
            'provinsi_id' => 'provinsi',
            'name'        => 'nama kota/kabupaten',
        ];
    }
}
