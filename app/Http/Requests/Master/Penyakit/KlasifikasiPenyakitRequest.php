<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

class KlasifikasiPenyakitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('klasifikasi_penyakit')) {
            return $this->user()->can('update', $this->route('klasifikasi_penyakit'));
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
            'kode'   => ['required'],
            'uraian' => ['required']
        ];
    }
}
