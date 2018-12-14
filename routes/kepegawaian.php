<?php

Route::namespace('Kepegawaian')->group(function () {
    /* */
    Route::apiResources([
        'jabatan'  => 'JabatanController',
        'kategori' => 'KategoriKualifikasiController',
    ]);
});
