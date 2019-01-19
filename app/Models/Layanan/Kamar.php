<?php

namespace App\Models\Layanan;

use Illuminate\Database\Eloquent\Model;
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
}
