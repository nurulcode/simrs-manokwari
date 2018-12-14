<?php

namespace App\Http\Requests\Fasilitas;

use App\Enums;
use Illuminate\Validation\Rule;
use App\Models\Fasilitas\Ruangan;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class RuanganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('ruangan')) {
            return $this->user()->can('update', $this->route('ruangan'));
        }

        return $this->user()->can('create', Ruangan::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = Rule::unique('ruangans')->ignore(
            optional($this->route('ruangan'))->id
        );

        return [
            'poliklinik_id' => ['required', 'exists:polikliniks,id'],
            'kode'          => ['required', $unique],
            'nama'          => ['required'],
            'kelas'         => ['required', new EnumValue(Enums\KelasRuangan::class)],
            'jenis'         => ['required', new EnumValue(Enums\JenisRuangan::class)],
        ];
    }
}
