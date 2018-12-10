<?php

namespace App\Http\Requests\Fasilitas;

use App\Models\Fasilitas\Ranjang;
use Illuminate\Foundation\Http\FormRequest;

class RanjangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('ranjang')) {
            return $this->user()->can('update', $this->route('ranjang'));
        }

        return $this->user()->can('create', Ranjang::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kamar_id' => ['required'],
            'kode'     => ['required'],
        ];
    }
}
