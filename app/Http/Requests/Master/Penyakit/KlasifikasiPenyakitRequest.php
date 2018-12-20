<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Validation\Rule;
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
        if ($this->route('klasifikasi')) {
            return $this->user()->can('update', $this->route('klasifikasi'));
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
        $unique = Rule::unique('klasifikasi_penyakits')->ignore(
            optional($this->route('klasifikasi'))->id
        );

        return [
            'kode'   => ['required', $unique],
            'uraian' => ['required', 'max:128']
        ];
    }
}
