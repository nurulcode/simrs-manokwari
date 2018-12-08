<?php

use App\Seeder;
use Sty\CsvSeeder;
use App\Models\Master\Kegiatan;
use App\Models\Master\KategoriKegiatan;
use App\Models\Master\Wilayah\Provinsi;
use App\Models\Master\Penyakit\Penyakit;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;
use App\Models\Master\Wilayah\KotaKabupaten;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

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
            Provinsi::class             => ['master/wilayah/provinsi.csv', 34],
            KotaKabupaten::class        => ['master/wilayah/kotakab.csv', 514],
            Kecamatan::class            => ['master/wilayah/kecamatan.csv', 7215],
            Kelurahan::class            => ['master/wilayah/kelurahan.csv', 80534],

            KategoriKegiatan::class     => ['master/kegiatan/kategori.csv', 13],
            Kegiatan::class             => ['master/kegiatan/kegiatan.csv', 373],
            KlasifikasiPenyakit::class  => ['master/penyakit/klasifikasi_penyakit.csv', 22],
            KelompokPenyakit::class     => ['master/penyakit/kelompok_penyakit.csv', 537],
            Penyakit::class             => ['master/penyakit/penyakit.csv', 13309],
        ]);

        $this->command->getOutput()->newLine(1);

        $this->command->info('-> Kategori Kegiatan Pivot');

        with(new CsvSeeder(
            'kategori_kegiatan_kegiatan',
            database_path('seeds/data/master/kegiatan/kategori_kegiatan_pivot.csv'),
            'master'
        ))->setProgressOutput($this->command->getOutput(), 404)
            ->select(1, 2, 3)
            ->setBatch(200)
            ->withTimestamps(false)
            ->seed();
    }
}
