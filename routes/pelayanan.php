<?php

Route::namespace('Pelayanan')->group(function () {
    Route::apiResources([
        'rawat-jalan' => 'RawatJalanController',
    ]);
});
