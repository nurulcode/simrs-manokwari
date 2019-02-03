<?php

namespace App\Http\Queries\Logistik;

use Sty\HttpQuery;

class TransaksiQuery extends HttpQuery
{
    public function jenis_transaksi_type($builder, $value)
    {
        return $builder->where('jenis_transaksi_type', $value);
    }

    public function jenis_transaksi_id($builder, $value)
    {
        return $builder->where('jenis_transaksi_id', $value);
    }
}
