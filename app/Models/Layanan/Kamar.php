<?php

namespace App\Models\Layanan;

use App\Models\Fasilitas\BelongsToRanjang;

class Kamar extends Layanan
{
    use BelongsToRanjang;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_kamars';

    public function path($action = 'show')
    {
        return;
    }
}
