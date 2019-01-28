<?php

Route::namespace('Layanan')->group(function () {
    Route::apiResources([
        'diagnosa'    => 'DiagnosaController',
        'keperawatan' => 'KeperawatanController',
        'pemeriksaan' => 'PemeriksaanController',
        'tindakan'    => 'TindakanController',
        'visite'      => 'VisiteController'
    ]);
});
