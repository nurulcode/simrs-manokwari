<?php

namespace App\Models;

use App\Enums\JenisTarif;
use App\Enums\KelasTarif;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['data', 'tarifable_type', 'tarifable_id'];

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
