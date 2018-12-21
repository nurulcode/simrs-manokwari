<?php

use App\Seeder;
use App\Models\Tarif\TarifRegistrasi;

class TarifTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            TarifRegistrasi::class  => ['tarif_registrasi.csv', 7]
        ]);
    }
}
