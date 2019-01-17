<?php

use App\Models\Master;
use App\Models\Pasien;
use App\Models\Kunjungan;
use Illuminate\Database\Seeder;
use App\Enums\KategoriRegistrasi;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Perawatan\RawatJalan;

class RandomRawatJalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kunjungan = factory(Kunjungan::class)->create([
            'pasien_id' => function () {
                return Pasien::inRandomOrder()->first()->id;
            },
            'kasus_id' => function () {
                return Master\Kasus::inRandomOrder()->first()->id;
            },
            'penyakit_id' => function () {
                return Master\Penyakit\Penyakit::inRandomOrder()->first()->id;
            },
            'jenis_rujukan_id' => function () {
                return Master\JenisRujukan::inRandomOrder()->first()->id;
            },
            'cara_pembayaran_id' => function () {
                return Master\CaraPembayaran::inRandomOrder()->first()->id;
            },
            'pasien_baru'     => 0,
        ]);

        factory(RawatJalan::class)->create([
            'kunjungan_id'        => $kunjungan->id,
            'jenis_registrasi_id' => function () {
                return Master\JenisRegistrasi::inRandomOrder()
                    ->where('kategori', KategoriRegistrasi::RAWAT_JALAN)
                    ->first()
                    ->id;
            },
            'kegiatan_id' => function () {
                return Master\Kegiatan::inRandomOrder()->first()->id;
            },
            'poliklinik_id' => function () {
                return Poliklinik::where('jenis_id', 1)->inRandomOrder()->first()->id;
            },
        ]);
    }
}
