<?php

Route::namespace('Kepegawaian')->group(function () {
    /* */
    Route::apiResources([
        'jabatan'     => 'JabatanController',
        'kategori'    => 'KategoriKualifikasiController',
        'kualifikasi' => 'KualifikasiController',
        'pegawai'     => 'PegawaiController',
    ]);
});
