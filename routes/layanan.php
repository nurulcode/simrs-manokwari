<?php

Route::namespace('Layanan')->group(function () {
    Route::apiResources([
        'diagnosa'    => 'DiagnosaController',
        'gizi'        => 'GiziController',
        'keperawatan' => 'KeperawatanController',
        'oksigen'     => 'OksigenController',
        'pemeriksaan' => 'PemeriksaanController',
        'tindakan'    => 'TindakanController',
        'visite'      => 'VisiteController'
    ]);
});
