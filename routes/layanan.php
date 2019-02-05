<?php

Route::namespace('Layanan')->group(function () {
    Route::apiResources([
        'diagnosa'           => 'DiagnosaController',
        'gizi'               => 'GiziController',
        'kebidanan'          => 'KebidananController',
        'keperawatan'        => 'KeperawatanController',
        'laundry'            => 'LaundryController',
        'oksigen'            => 'OksigenController',
        'pemeriksaan'        => 'PemeriksaanController',
        'penunjang'          => 'PenunjangController',
        'penunjang_tindakan' => 'PenunjangTindakanController',
        'perinatologi'       => 'PerinatologiController',
        'resep'              => 'ResepController',
        'tindakan'           => 'TindakanController',
        'visite'             => 'VisiteController'
    ]);
});
