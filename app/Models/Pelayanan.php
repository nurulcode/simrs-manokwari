<?php

namespace App\Models;

class Pelayanan extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['layanan'];

    public function layanan()
    {
        return $this->morphTo();
    }
}
