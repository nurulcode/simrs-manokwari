<?php

Route::namespace('Master')->group(function () {
    /*  */
    Route::get('kategori-kegiatan/{kategori}/kegiatan', 'KegiatanKategoriKegiatanController');

    Route::post('kategori-kegiatan/{kategori}/kegiatan', 'KegiatanController@store');

    Route::apiResources([
        'agama'                => 'AgamaController',
        'cara-pembayaran'      => 'CaraPembayaranController',
        'jenis-poliklinik'     => 'JenisPoliklinikController',
        'jenis-identitas'      => 'JenisIdentitasController',
        'jenis-rujukan'        => 'JenisRujukanController',
        'jenis-registrasi'     => 'JenisRegistrasiController',
        'kasus'                => 'KasusController',
        'kategori-kegiatan'    => 'KategoriKegiatanController',
        'kegiatan'             => 'KegiatanController',
        'pekerjaan'            => 'PekerjaanController',
        'pendidikan'           => 'PendidikanController',
        'suku'                 => 'SukuController',
        'tindakan-pemeriksaan' => 'TindakanPemeriksaanController'
    ]);

    Route::namespace('Wilayah')->prefix('wilayah')->name('wilayah.')->group(function () {
        Route::get('provinsi/{provinsi}/kota-kabupaten', 'ProvinsiKotaKabupatenController');

        Route::post('provinsi/{provinsi}/kota-kabupaten', 'KotaKabupatenController@store');

        Route::get('kota-kabupaten/{kota_kabupaten}/kecamatan', 'KotaKabupatenKecamatanController');

        Route::post('kota-kabupaten/{kota_kabupaten}/kecamatan', 'KecamatanController@store');

        Route::get('kecamatan/{kecamatan}/kelurahan', 'KecamatanKelurahanController');

        Route::post('kecamatan/{kecamatan}/kelurahan', 'KelurahanController@store');

        Route::apiResources([
            'provinsi'       => 'ProvinsiController',
            'kota-kabupaten' => 'KotaKabupatenController',
            'kecamatan'      => 'KecamatanController',
            'kelurahan'      => 'KelurahanController',
        ]);
    });

    Route::namespace('Penyakit')->prefix('penyakit')->name('penyakit.')->group(function () {
        Route::get('klasifikasi/{klasifikasi}/kelompok', 'KlasifikasiKelompokPenyakitController');

        Route::post('klasifikasi/{klasifikasi}/kelompok', 'KelompokPenyakitController@store');

        Route::get('kelompok/{kelompok}/penyakit', 'KelompokPenyakitPenyakitController');

        Route::post('kelompok/{kelompok}/penyakit', 'PenyakitController@store');

        Route::apiResources([
            'klasifikasi'    => 'KlasifikasiPenyakitController',
            'kelompok'       => 'KelompokPenyakitController',
            'penyakit'       => 'PenyakitController'
        ]);
    });
});
