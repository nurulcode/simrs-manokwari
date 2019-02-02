<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class LogistikQuery extends HttpQuery
{
    public function jenis($builder, $value)
    {
        return $builder->where('jenis_id', $value);
    }
}
