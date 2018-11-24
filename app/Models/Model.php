<?php

namespace App\Models;

use Sty\HasPath;
use Sty\ResourceModel;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel implements ResourceModel
{
    use HasPath;
}
