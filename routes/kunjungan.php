<?php

Route::namespace('Kunjungan')->group(function () {
    /* */
    Route::resources([
        'rawat-jalan' => 'RawatJalanController',
    ]);
});
