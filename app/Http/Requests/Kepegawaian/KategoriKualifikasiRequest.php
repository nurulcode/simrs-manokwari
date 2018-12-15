<?php

namespace App\Http\Requests\Kepegawaian;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KategoriKualifikasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kategori')) {
            return $this->user()->can('update', $this->route('kategori'));
        }

        return $this->user()->can('create', KategoriKualifikasi::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = Rule::unique('kategori_kualifikasis')->ignore(
            optional($this->route('kategori'))->id
        );

        return [
            'kode'            => ['required', $unique],
            'tenaga_medis'    => ['required'],
            'uraian'          => ['required', 'max:255'],
        ];
    }
}
