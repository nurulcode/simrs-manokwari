<?php

namespace App\Http\Requests\Master;

use App\Rules\ValidEnum;
use Sty\RequestTransform;
use Illuminate\Validation\Rule;
use App\Enums\JenisTindakanPemeriksaan;
use App\Models\Master\TindakanPemeriksaan;
use Illuminate\Foundation\Http\FormRequest;

class TindakanPemeriksaanRequest extends FormRequest
{
    use RequestTransform;

    /**
     * The attributes value to map.
     *
     * @var array
     *
     */
    protected $map_values = ['jenis' => 'jenis.value'];

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
        $unique = Rule::unique('master.tindakan_pemeriksaans')->ignore(
            optional($this->route('tindakan_pemeriksaan'))->id
        );

        return [
            'kode'      => ['required', $unique],
            'parent_id' => ['nullable', 'exists:master.tindakan_pemeriksaans,id'],
            'uraian'    => ['required', 'max:128'],
            'jenis'     => ['required', new ValidEnum(JenisTindakanPemeriksaan::class)]
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
