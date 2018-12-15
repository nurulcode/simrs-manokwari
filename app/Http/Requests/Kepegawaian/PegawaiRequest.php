<?php

namespace App\Http\Requests\Kepegawaian;

use App\Enums\JenisKelamin;
use BenSampo\Enum\Rules\EnumValue;
use App\Models\Kepegawaian\Pegawai;
use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('pegawai')) {
            return $this->user()->can('update', $this->route('pegawai'));
        }

        return $this->user()->can('create', Pegawai::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kualifikasi_id' => ['required', 'exists:kualifikasis,id'],
            'nama'           => ['required'],
            'jenis_kelamin'  => ['required', new EnumValue(JenisKelamin::class)],
            'jabatan_id'     => ['nullable', 'exists:jabatans,id'],
            'tempat_lahir'   => ['nullable'],
            'tanggal_lahir'  => ['nullable', 'date'],
            'alamat'         => ['nullable'],
            'telepon'        => ['nullable'],
        ];
    }
}
