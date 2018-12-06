<?php

namespace App\Http\Queries\Master\Wilayah;

use Sty\HttpQuery;

class KecamatanQuery extends HttpQuery
{
    public function kota_kabupaten($builder, $kota_kabupaten_id)
    {
        return $builder->where('kota_kabupaten_id', $kota_kabupaten_id);
    }
}
