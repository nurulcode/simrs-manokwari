<?php

namespace App\Models;

use Sty\HasPath;
use Sty\FilterScope;
use Sty\ResourceModel;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel implements ResourceModel
{
    use HasPath, FilterScope;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
