<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class PasienQuery extends HttpQuery
{
    public function mr($builder, $value = '')
    {
        if (!$value) {
            return $builder;
        }

        return $builder->where('no_rekam_medis', 'LIKE', '%' . $value . '%');
    }
}
