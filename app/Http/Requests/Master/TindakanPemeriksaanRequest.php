<?php

namespace App\Http\Requests\Master;

use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\JenisTindakanPemeriksaan;
use App\Models\Master\TindakanPemeriksaan;
use Illuminate\Foundation\Http\FormRequest;

class TindakanPemeriksaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('tindakan_pemeriksaan')) {
            return $this->user()->can('update', $this->route('tindakan_pemeriksaan'));
        }

        return $this->user()->can('create', TindakanPemeriksaan::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = Rule::unique('tindakan_pemeriksaans')->ignore(
            optional($this->route('tindakan_pemeriksaan'))->id
        );

        return [
            'kode'      => ['required', $unique],
            'parent_id' => ['nullable', 'exists:tindakan_pemeriksaans,id'],
            'uraian'    => ['required', 'max:128'],
            'jenis'     => ['required', new EnumValue(JenisTindakanPemeriksaan::class)]
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return ['parent_id' => 'parent'];
    }
}
