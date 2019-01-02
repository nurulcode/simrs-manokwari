<?php

namespace App\Models;

use Sty\HasPath;
use Sty\HasPolicy;
use Sty\Searchable;
use Sty\FilterScope;
use Sty\ResourceModel;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel implements ResourceModel
{
    use HasPath, FilterScope, HasPolicy, Searchable, RecordsActivity;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public static function make($var)
    {
        return new static($var);
    }
}
