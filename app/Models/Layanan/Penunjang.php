<?php

namespace App\Models\Layanan;

use App\Models\Fasilitas\BelongsToPoliklinik;

class Penunjang extends Layanan
{
    use BelongsToPoliklinik;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_penunjangs';
}
