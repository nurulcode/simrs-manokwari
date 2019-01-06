<?php

namespace App\Http\Queries\Fasilitas;

use Sty\HttpQuery;

class RanjangQuery extends HttpQuery
{
    public function kamar($builder, $value)
    {
        return $builder->where('kamar_id', $value);
    }
}
