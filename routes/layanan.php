<?php

Route::namespace('Layanan')->group(function () {
    Route::apiResources([
        'diagnosa'    => 'DiagnosaController',
        'keperawatan' => 'KeperawatanController',
        'oksigen'     => 'OksigenController',
        'pemeriksaan' => 'PemeriksaanController',
        'tindakan'    => 'TindakanController',
        'visite'      => 'VisiteController'
    ]);
});
