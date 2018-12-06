<?php

namespace App\Http\Requests\Master;

use App\Models\Master\KategoriKegiatan;
use Illuminate\Foundation\Http\FormRequest;

class KategoriKegiatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kategori_kegiatan')) {
            return $this->user()->can('update', $this->route('kategori_kegiatan'));
        }

        return $this->user()->can('create', KategoriKegiatan::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['uraian' => 'required|max:128'];
    }
}
