<?php


Route::namespace('Perawatan')->group(function () {
    Route::middleware('can:manage_rawat_jalan')->group(function () {
        Route::apiResource('rawat-jalan', 'RawatJalanController');

        Route::get('rawat-jalan/{rawat_jalan}/diagnosa',   'RawatJalanDiagnosaController@index');

        Route::post('rawat-jalan/{rawat_jalan}/diagnosa',  'RawatJalanDiagnosaController@store');
    });
});
