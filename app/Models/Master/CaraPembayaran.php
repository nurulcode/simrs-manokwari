<?php

namespace App\Models\Master;

class CaraPembayaran extends Master
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

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeOnlyFirstLevel($query)
    {
        return $query->whereNull('parent_id')->orderBy('uraian');
    }
}
