<?php

namespace App\Http\Requests\Master;

use App\Models\Master\JenisPoliklinik;
use Illuminate\Foundation\Http\FormRequest;

class JenisPoliklinikRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('jenis_poliklinik')) {
            return $this->user()->can('update', $this->route('jenis_poliklinik'));
        }

        return $this->user()->can('create', JenisPoliklinik::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['uraian' => 'required'];
    }
}
