<?php

use App\Seeder;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KepegawaianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            KategoriKualifikasi::class  => ['kepegawaian/kategori.csv', 13],
        ]);
    }
}
