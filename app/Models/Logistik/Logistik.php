<?php

namespace App\Models\Logistik;

use App\Models\Model;
use App\Models\Master\JenisLogistik;

class Logistik extends Model
{
    public function jenis()
    {
        return $this->belongsTo(JenisLogistik::class);
    }

    public function orderByJenis($builder, $direction = 'asc')
    {
        $jenis = JenisLogistik::select('uraian')->whereColumn('id', 'jenis_id');

        $builder->orderBySub($jenis, $direction);

        $builder->orderBy('uraian', 'asc');

        return $builder;
    }
}
