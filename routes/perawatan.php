<?php

Route::namespace('Perawatan')->group(function () {
    Route::apiResources([
        'rawat-jalan' => 'RawatJalanController',
    ]);
});
