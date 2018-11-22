<?php

namespace App\Models;

use Sty\HasPath;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    use HasPath;
}
