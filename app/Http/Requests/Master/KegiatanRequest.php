<?php

namespace App\Http\Requests\Master;

use App\Models\Master\Kegiatan;
use Illuminate\Foundation\Http\FormRequest;

class KegiatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kegiatan')) {
            return $this->user()->can('update', $this->route('kegiatan'));
        }

        return $this->user()->can('create', Kegiatan::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id'       => ['nullable', 'exists:master.kegiatans,id'],
            'uraian'          => ['required', 'max:128'],
            'kategori'        => ['nullable'],
            'kategori.*.kode' => ['required'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'kategori.*.kode' => 'kode kategori',
        ];
    }
}
