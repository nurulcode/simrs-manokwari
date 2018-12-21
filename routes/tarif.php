<?php

Route::namespace('Tarif')->group(function () {
    /* */
    Route::apiResources([
        'registrasi' => 'TarifRegistrasiController',
    ]);
});
