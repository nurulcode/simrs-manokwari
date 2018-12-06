<?php

namespace App\Http\Queries\Master\Wilayah;

use Sty\HttpQuery;

class KelurahanQuery extends HttpQuery
{
    public function kecamatan($builder, $kecamatan_id)
    {
        return $builder->where('kecamatan_id', $kecamatan_id);
    }
}
