<?php

namespace App\Http\Requests\Master;

use App\Models\Master\CaraPembayaran;
use Illuminate\Foundation\Http\FormRequest;

class CaraPembayaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('cara_pembayaran')) {
            return $this->user()->can('update', $this->route('cara_pembayaran'));
        }

        return $this->user()->can('create', CaraPembayaran::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => ['nullable', 'exists:cara_pembayarans,id'],
            'kode'      => ['required'],
            'uraian'    => ['required', 'max:128'],
        ];
    }
}
