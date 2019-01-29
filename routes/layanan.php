<?php

Route::namespace('Layanan')->group(function () {
    Route::apiResources([
        'diagnosa'    => 'DiagnosaController',
        'gizi'        => 'GiziController',
        'keperawatan' => 'KeperawatanController',
        'laundry'     => 'LaundryController',
        'oksigen'     => 'OksigenController',
        'pemeriksaan' => 'PemeriksaanController',
        'penunjang'   => 'PenunjangController',
        'tindakan'    => 'TindakanController',
        'visite'      => 'VisiteController'
    ]);
});
