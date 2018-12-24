<?php

use App\Seeder;
use App\Models\Master;

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
            Master\Agama::class                => ['master/agama.csv', 7],
            Master\CaraPembayaran::class       => ['master/cara_bayars.csv', 9],
            Master\JenisIdentitas::class       => ['master/jenis_identitas.csv', 10],
            Master\JenisPoliklinik::class      => ['master/jenis_poliklinik.csv', 12],
            Master\JenisRujukan::class         => ['master/jenis_rujukan.csv', 7],
            Master\JenisRegistrasi::class      => ['master/jenis_registrasi.csv', 7],
            Master\Kasus::class                => ['master/kasus.csv', 9],
            Master\KategoriKegiatan::class     => ['master/kegiatan/kategori.csv', 13],
            Master\Kegiatan::class             => ['master/kegiatan/kegiatan.csv', 373],
            Master\Pekerjaan::class            => ['master/pekerjaan.csv', 13],
            Master\Pendidikan::class           => ['master/pendidikan.csv', 10],
            Master\Suku::class                 => ['master/suku.csv', 15],
            Master\TindakanPemeriksaan::class  => ['master/tindakan_pemeriksaan.csv', 428],
        ]);
    }
}
