<?php

use App\Seeder;
use App\Models\Master\Wilayah\Provinsi;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            Provinsi::class => ['master/wilayah/provinsi.csv', 34]
        ]);
    }
}
