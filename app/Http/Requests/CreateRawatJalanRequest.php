<?php

namespace App\Http\Requests;

use App\Models\RawatJalan;

class CreateRawatJalanRequest extends KunjunganRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', RawatJalan::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'kegiatan_id'   => ['required'],
            'poliklinik_id' => ['required'],
        ]);
    }
}
