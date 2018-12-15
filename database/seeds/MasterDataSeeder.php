<?php

use App\Seeder;
use App\Models\Master\Suku;
use App\Models\Master\Agama;
use App\Models\Master\Kasus;
use App\Models\Master\Kegiatan;
use App\Models\Master\Pekerjaan;
use App\Models\Master\Pendidikan;
use App\Models\Master\JenisIdentitas;
use App\Models\Master\JenisPoliklinik;
use App\Models\Master\KategoriKegiatan;
use App\Models\Master\TindakanPemeriksaan;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MasterDataWilayahSeeder::class);
        $this->call(MasterDataPenyakitSeeder::class);

        $this->seeds([
            Agama::class                => ['master/agama.csv', 7],
            JenisPoliklinik::class      => ['master/jenis_poliklinik.csv',   12],
            JenisIdentitas::class       => ['master/jenis_identitas.csv',    10],
            Kasus::class                => ['master/kasus.csv',               9],
            KategoriKegiatan::class     => ['master/kegiatan/kategori.csv',  13],
            Kegiatan::class             => ['master/kegiatan/kegiatan.csv', 373],
            Pekerjaan::class            => ['master/pekerjaan.csv',  13],
            Pendidikan::class           => ['master/pendidikan.csv', 10],
            Suku::class                 => ['master/suku.csv', 15],
            TindakanPemeriksaan::class  => ['master/tindakan_pemeriksaan.csv', 428],
        ]);
    }
}
