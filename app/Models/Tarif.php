<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\KelasTarif;
use App\Enums\JenisTarif;

class Tarif extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['data'];

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

    public function getDataAttribute($value)
    {
        $data = collect([]);

        foreach ($this->kelas_tarif as $kelas) {
            $data->put($kelas, $this->getTarifKelas($kelas));
        }

        return $data;
    }

    public function getTarifKelas($kelas)
    {
        $value = json_decode(array_get($this->attributes, 'data', ''), true);

        $tarif = array_get($value, $kelas, []);

        foreach ($this->jenis_tarif as $jenis) {
            data_fill($tarif, $jenis, 0);
        }

        return $tarif;
    }

    public function getKelasTarifAttribute()
    {
        return array_unique(KelasTarif::getValues());
    }

    public function getJenisTarifAttribute()
    {
        return array_unique(JenisTarif::getValues());
    }
}
