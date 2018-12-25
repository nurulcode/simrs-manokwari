<?php


Route::namespace('Perawatan')->group(function () {
    Route::apiResources([
        'rawat-jalan' => 'RawatJalanController',
    ]);

    Route::get('rawat-jalan/{rawat_jalan}/diagnosa',  'RawatJalanDiagnosaController@index');

    Route::post('rawat-jalan/{rawat_jalan}/diagnosa',  'RawatJalanDiagnosaController@store');
});
