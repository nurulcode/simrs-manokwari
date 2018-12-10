<?php

namespace App\Http\Requests\Fasilitas;

use Illuminate\Foundation\Http\FormRequest;

class KamarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kamar')) {
            return $this->user()->can('update', $this->route('kamar'));
        }

        return $this->user()->can('create', Kamar::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'poliklinik_id' => ['required', 'exists:polikliniks,id'],
            'ruangan_id' => ['required'],
            'nama'       => ['required'],
        ];
    }
}
