<?php

namespace App\Models;

class Activity extends Model
{
    public function subject()
    {
        return $this->morphTo();
    }
}
