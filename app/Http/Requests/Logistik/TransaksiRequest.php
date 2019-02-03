<?php

namespace App\Http\Requests\Logistik;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis_transaksi_type' => 'required',
            'jenis_transaksi_id'   => 'required|morph_exists:jenis_transaksi_type',
            'apotek_id'            => 'required|exists:polikliniks,id',
            'logistik_id'          => 'required|exists:logistiks,id',
            'harga'                => 'required',
            'jumlah'               => 'required',
        ];
    }
}
