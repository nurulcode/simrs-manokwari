<?php

namespace App\Http\Requests\Tarif;

use App\Enums\KategoriRegistrasi;
use BenSampo\Enum\Rules\EnumValue;
use App\Models\Tarif\TarifRegistrasi;
use Illuminate\Foundation\Http\FormRequest;

class TarifRegistrasiRequest extends FormRequest
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

        return $this->user()->can('create', TarifRegistrasi::class);
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
            'uraian'          => ['required', 'max:128'],
            'tarif_sarana'    => ['required', 'integer'],
            'tarif_pelayanan' => ['required', 'integer'],
            'tarif_bhp'       => ['required', 'integer']
        ];
    }
}
