<?php

Route::namespace('Perawatan')->group(function () {
    /** */
    Route::middleware('can:manage_rawat_jalan')->group(function () {
        Route::apiResource('rawat-jalan', 'RawatJalanController');
        Route::post('rawat_jalan/{rawat_jalan}/pulang', 'RawatJalanPulangController');
    });

    Route::middleware('can:manage_rawat_darurat')->group(function () {
        Route::apiResource('rawat-darurat', 'RawatDaruratController');
    });

    Route::middleware('can:manage_rawat_inap')->group(function () {
        Route::apiResource('rawat-inap', 'RawatInapController');

        Route::post('rawat_inap/{rawat_inap}/pulang', 'RawatInapPulangController');
    });
});
