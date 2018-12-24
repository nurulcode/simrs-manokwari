<?php

namespace App\Http\Requests\Master;

use App\Enums\KategoriRegistrasi;
use BenSampo\Enum\Rules\EnumValue;
use App\Models\Master\JenisRegistrasi;
use Illuminate\Foundation\Http\FormRequest;

class JenisRegistrasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('registrasi')) {
            return $this->user()->can('update', $this->route('registrasi'));
        }

        return $this->user()->can('create', JenisRegistrasi::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kategori'        => ['required', new EnumValue(KategoriRegistrasi::class)],
            'uraian'          => ['required', 'max:128']
        ];
    }
}
