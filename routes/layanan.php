<?php

Route::namespace('Layanan')->group(function () {
    Route::apiResources([
        'diagnosa' => 'DiagnosaController',
    ]);
});
