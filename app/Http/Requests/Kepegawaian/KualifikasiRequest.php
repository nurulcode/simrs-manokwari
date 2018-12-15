<?php

namespace App\Http\Requests\Kepegawaian;

use Illuminate\Validation\Rule;
use App\Models\Kepegawaian\Kualifikasi;
use Illuminate\Foundation\Http\FormRequest;

class KualifikasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kualifikasi')) {
            return $this->user()->can('update', $this->route('kualifikasi'));
        }

        return $this->user()->can('create', Kualifikasi::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = Rule::unique('kualifikasis')->ignore(
            optional($this->route('kualifikasi'))->id
        );

        return [
            'kategori_id' => ['required', 'exists:kategori_kualifikasis,id'],
            'kode'        => ['required', $unique],
            'uraian'      => ['required', 'max:255'],
            'laki_laki'   => ['required', 'numeric', 'integer'],
            'perempuan'   => ['required', 'numeric', 'integer'],
        ];
    }
}
