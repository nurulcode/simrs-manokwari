<?php

namespace App\Models;

trait BelongsToItself
{
    public function initializeBelongsToItself()
    {
        array_push($this->with, 'parent');
    }

    public function parent()
    {
        return $this->belongsTo(get_called_class());
    }

    public function childs()
    {
        return $this->hasMany(get_called_class(), 'parent_id');
    }
}
