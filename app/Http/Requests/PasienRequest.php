<?php

namespace App\Http\Requests;

use App\Models\Pasien;
use Sty\RequestTransform;
use Illuminate\Foundation\Http\FormRequest;

class PasienRequest extends FormRequest
{
    use RequestTransform;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('pasien')) {
            return $this->user()->can('update', $this->route('pasien'));
        }

        return $this->user()->can('create', Pasien::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis_identitas_id' => ['required'],
            'nomor_identitas'    => ['required'],
            'nama'               => ['required'],
            'jenis_kelamin'      => ['required'],
            'tempat_lahir'       => ['nullable'],
            'tanggal_lahir'      => ['nullable'],
            'golongan_darah'     => ['nullable'],
            'agama_id'           => ['nullable'],
            'suku_id'            => ['nullable'],
            'pendidikan_id'      => ['nullable'],
            'pekerjaan_id'       => ['nullable'],
            'alamat'             => ['nullable'],
            'kelurahan_id'       => ['nullable'],
            'telepon'            => ['nullable'],
            'nama_ayah'          => ['nullable'],
            'nama_ibu'           => ['nullable'],
            'alamat_keluarga'    => ['nullable'],
            'telepon_keluarga'   => ['nullable'],
            'status_pernikahan'  => ['nullable'],
            'nama_pasangan'      => ['nullable'],
        ];
    }

    public function with()
    {
        if ($this->route('pasien')) {
            return [];
        }

        return ['tanggal_registrasi' => now()];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'jenis_identitas_id' => 'jenis identitas'
        ];
    }
}
