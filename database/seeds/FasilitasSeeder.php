<?php

use App\Seeder;
use App\Models\Fasilitas\Ruangan;
use App\Models\Fasilitas\Poliklinik;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            Poliklinik::class => ['fasilitas/polikliniks.csv', 35],
            Ruangan::class    => ['fasilitas/ruangans.csv', 15],
        ]);
    }
}
