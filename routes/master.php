<?php

Route::namespace('Master')->group(function () {
    /*  */
    Route::apiResources([
        'agama'                => 'AgamaController',
        'cara-pembayaran'      => 'CaraPembayaranController',
        'jenis-poliklinik'     => 'JenisPoliklinikController',
        'jenis-identitas'      => 'JenisIdentitasController',
        'jenis-rujukan'        => 'JenisRujukanController',
        'jenis-registrasi'     => 'JenisRegistrasiController',
        'jenis-visite'         => 'JenisVisiteController',
        'kasus'                => 'KasusController',
        'kategori-kegiatan'    => 'KategoriKegiatanController',
        'kegiatan'             => 'KegiatanController',
        'pekerjaan'            => 'PekerjaanController',
        'pemeriksaan-umum'     => 'PemeriksaanUmumController',
        'pendidikan'           => 'PendidikanController',
        'perawatan-khusus'     => 'PerawatanKhususController',
        'suku'                 => 'SukuController',
        'tindakan-pemeriksaan' => 'TindakanPemeriksaanController',
        'tipe-diagnosa'        => 'TipeDiagnosaController'
    ]);

    Route::namespace('Wilayah')->prefix('wilayah')->name('wilayah.')->group(function () {
        Route::apiResources([
            'provinsi'       => 'ProvinsiController',
            'kota-kabupaten' => 'KotaKabupatenController',
            'kecamatan'      => 'KecamatanController',
            'kelurahan'      => 'KelurahanController',
        ]);
    });

    Route::namespace('Penyakit')->prefix('penyakit')->name('penyakit.')->group(function () {
        Route::apiResources([
            'klasifikasi'    => 'KlasifikasiPenyakitController',
            'kelompok'       => 'KelompokPenyakitController',
            'penyakit'       => 'PenyakitController'
        ]);
    });
});
