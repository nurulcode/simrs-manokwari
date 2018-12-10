<?php

Route::namespace('Fasilitas')->group(function () {
    Route::get('poliklinik/{poliklinik}/ruangan', 'PoliklinikRuanganController');

    Route::post('poliklinik/{poliklinik}/ruangan', 'RuanganController@store');

    Route::get('ruangan/{ruangan}/kamar', 'RuanganKamarController');

    Route::post('ruangan/{ruangan}/kamar', 'KamarController@store');

    Route::get('kamar/{kamar}/ranjang', 'KamarRanjangController');

    Route::post('kamar/{kamar}/ranjang', 'RanjangController@store');

    Route::apiResources([
        'poliklinik' => 'PoliklinikController',
        'ruangan'    => 'RuanganController',
        'kamar'      => 'KamarController',
        'ranjang'    => 'RanjangController',
    ]);
});
