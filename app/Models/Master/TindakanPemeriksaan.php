<?php

namespace App\Models\Master;

class TindakanPemeriksaan extends Master
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['parent'];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }
}
