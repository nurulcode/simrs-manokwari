<?php

Route::namespace('Kepegawaian')->group(function () {
    /* */
    Route::apiResources([
        'kategori' => 'KategoriKualifikasiController',
    ]);
});
