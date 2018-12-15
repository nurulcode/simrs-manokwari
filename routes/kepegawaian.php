<?php

Route::namespace('Kepegawaian')->group(function () {
    /* */
    Route::get('jabatan/{jabatan}/pegawai', 'JabatanPegawaiController');

    Route::post('jabatan/{jabatan}/pegawai', 'PegawaiController@store');

    Route::get('kategori/{kategori}/kualifikasi', 'KategoriKualifikasiKualifikasiController');

    Route::post('kategori/{kategori}/kualifikasi', 'KualifikasiController@store');

    Route::get('kualifikasi/{kualifikasi}/pegawai', 'KualifikasiPegawaiController');

    Route::post('kualifikasi/{kualifikasi}/pegawai', 'PegawaiController@store');

    Route::apiResources([
        'jabatan'     => 'JabatanController',
        'kategori'    => 'KategoriKualifikasiController',
        'kualifikasi' => 'KualifikasiController',
        'pegawai'     => 'PegawaiController',
    ]);
});
