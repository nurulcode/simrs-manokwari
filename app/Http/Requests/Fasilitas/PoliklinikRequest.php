<?php

namespace App\Http\Requests\Fasilitas;

use App\Models\Fasilitas\Poliklinik;
use Illuminate\Foundation\Http\FormRequest;

class PoliklinikRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('poliklinik')) {
            return $this->user()->can('update', $this->route('poliklinik'));
        }

        return $this->user()->can('create', Poliklinik::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kode'     => ['required'],
            'nama'     => ['required'],
            'jenis_id' => ['required']
        ];
    }
}
