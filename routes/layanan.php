<?php

Route::namespace('Layanan')->group(function () {
    Route::apiResources([
        'diagnosa'    => 'DiagnosaController',
        'pemeriksaan' => 'PemeriksaanController',
        'tindakan'    => 'TindakanController',
        'visite'      => 'VisiteController'
    ]);
});
