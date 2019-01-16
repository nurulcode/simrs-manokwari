<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tarif', 'tarifable_type', 'tarifable_id'
    ];

    public function setTarifAttribute($value)
    {
        $this->attributes['tarif'] = json_encode($value);
    }
}
